<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Category;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\JobNotificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{

    // this method will show jobs pages
    public function index(Request $request) {
        $categories = Category::where('status',1)->get();
        $jobTypes = JobType::where('status',1)->get();

        $jobs = Job::where('status',1);

        // search using keyword
        if(!empty($request->keyword)){
          $jobs = $jobs->where(function($query) use ($request) {
             $query->orWhere('title', 'like', '%'.$request->keyword.'%');
             $query->orWhere('keyword', 'like', '%'.$request->keyword.'%');
          });
        }

        // Search using location

        if(!empty($request->location)) {
          $jobs = $jobs->where('location',$request->location);
        }

          // Search using Category

          if(!empty($request->category)) {
            $jobs = $jobs->where('category_id',$request->category);
          }



          $jobTypeArray = [];
              // Search using jobType

              if(!empty($request->jobType)) {
                $jobTypeArray = explode(',',$request->jobType);
                $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
              }


                 // Search using experience

          if(!empty($request->experience)) {
            $jobs = $jobs->where('experience',$request->experience);
          }
          

       $jobs = $jobs->with(['jobType','category']);

       
     
       if($request->sort == '0') {
        $jobs = $jobs->orderBy('created_at', 'ASC');

       }else{
        $jobs = $jobs->orderBy('created_at', 'DESC');
         
       }

  
       $jobs = $jobs->paginate(9);

      return view('front.jobs',[
        'categories' => $categories,
        'jobTypes' =>  $jobTypes,
        'jobs' => $jobs,
        'jobTypeArray' => $jobTypeArray
      ]);
    }


    // This method will show job detail page
    public function detail(string $id) {
      $job = Job::where(['id' => $id, 'status' => 1])
          ->with(['jobType', 'category'])
         ->first(); 

      if($job == null) {
        abort(404);
      }

      $count = 0;
      if(Auth::check()) {
        $count = SavedJob::where(['user_id' => Auth::user()->id, 'job_id' => $id])->count();
      }


      // fetch applicants

      $applications = JobApplication::where('job_id',$id)->with('user')->get();


       return view('front.jobDetail',[
        'job' => $job,
        'count' => $count,
        'applications' => $applications
       ]);
    }

    public function applyJob(Request $request) {
       $id = $request->id;

       $job = Job::where('id',$id)->first();

    
      //  if job not found in db
       if($job == null) {
        $message = 'Job does not exist';
        session()->flash('error', $message);
        return response()->json([
             'status' => false,
             'message' => $message
        ]);
       }

      //  You can not apply on your own job
      $employer_id = $job->user_id;

      if($employer_id == Auth::user()->id) {
        $message = 'You can not apply on your own job';
        session()->flash('error', $message);
        return response()->json([
             'status' => false,
             'message' => $message
            ]);
      }

      // You can not apply on a job twise
      $jobApplicationCount = JobApplication::where([
         'user_id' => Auth::user()->id,
         'job_id' => $id
      ])->count();

      if($jobApplicationCount > 0) {
        $message = 'You alerady applied on this job';
        session()->flash('error', $message);
        return response()->json([
             'status' => false,
             'message' => $message
            ]);
      }

      $applications = new JobApplication();
      $applications->job_id  = $id;
      $applications->user_id = Auth::user()->id;
      $applications->employer_id = $employer_id;
      $applications->applied_date = now();
      $applications->save();

      // Send Notification Email to employer
      $employer = User::where('id',$employer_id)->first();
      $mailData = [
            'employer' => $employer,
            'user' => Auth::user(),
            'job' => $job,

      ];
       Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

      $message = 'You have successfully applied';
      session()->flash('success', $message);
      return response()->json([
           'status' => true,
           'message' => $message
          ]);

    }


    public function saveJob(Request $request) {
         $id = $request->id;

         $job = Job::find($id);

         if($job == null) {
          session()->flash('error','job not Found');
          return response()->json([
            'status' => false,
          ]);
           
         }

        // check if user already saved the job
    $count = SavedJob::where(['user_id' => Auth::user()->id, 'job_id' => $id])->count();

    if($count > 0) {
      session()->flash('error','you already saved on this job.');
      return response()->json([
        'status' => false,
       ]);
    }

    $saveJob = new SavedJob();
    $saveJob->job_id = $id;
    $saveJob->user_id = Auth::user()->id;
    $saveJob->save();


    session()->flash('success','you have successfully saved the job.');
    return response()->json([
      'status' => true,
     ]);
    }



   

}
