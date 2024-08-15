<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Category;
use App\Models\SavedJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

class AccountController extends Controller
{
    public function registration() {
        return view('front.account.registraion');
    }


    public function processRegistraion(Request $request) {
        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
        ]);

        if($validator->passes()) {

            $users = new User;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->save();


            session()->flash("success", 'You have registerd successfully.');
            return response()->json([
               'status' => true,
               'message' => 'You have registerd successfully.'
            ]);

        }else{
            return response()->json([
               'status' => false,
               'errors' => $validator->errors()
            ]);
        }
    }
    public function login() {
        return view('front.account.login');
    }

    public function authenticate(Request $request) {

        $request->validate([
          'email' => 'required|email:',
             'password' => 'required'
        ]);
   
      
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
              return redirect()->route('account.profile');

            }else{
                return redirect()->route('account.login')
                ->with('error','Either Email/Password is incorrect')->withInput($request->only('email'));
            }

    
       
    }

    public function profile() {
        $id = Auth::User()->id;
        $user = User::where('id',$id)->first();

        
        return view('front.account.profile',[
            'user' => $user
            ]);
    }

    public function updateProfile(Request $request) {
        $id = Auth::User()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);

        if($validator->passes()){
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

           session()->flash('success', 'Profile updated successfully');      
            return response()->json([
               'status' => true,
               'message' => 'Profile updated successfully'
            ]);


        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
             ]);
 
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('account.login');
    }



    public function updateProfilePic(Request $request) {

        $id = Auth::User()->id;

       $validator = Validator::make($request->all(),[
          'image' => 'required|image'

       ]);

       if($validator->passes()) {
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = $id. '-'.time().'.'.$ext;
        $image->move(public_path('/profile_pic'),$imageName);

         // Create profile pic thumb

         $ImageLocation = public_path().'/profile_pic/'.$imageName;
         $imagePath = Image::read($ImageLocation);
         $destinationPathThumbnail = public_path('/profile_pic/thumb/');
         $imagePath->cover(150, 150);
         $imagePath->save($destinationPathThumbnail.$imageName);
        

        //  Delete Old Profile pic
        File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
        File::delete(public_path('/profile_pic/'.Auth::user()->image));


        User::where('id',$id)->update([
           'image' => $imageName
        ]);


       

        session()->flash('success', 'Profile picture updated successfully');      
        return response()->json([
           'status' => true,
           'message' => 'Profile picture updated successfully'
        ]);

       }else{
        return response()->json([
           'status' => false,
           'errors' => $validator->errors()
        ]);
       }

    }


    public function createJob() {
       $categories = Category::orderBy('name','ASC')->where('status',1)->get();

       $jobTypes = JobType::orderBy('name','ASC')->where('status',1)->get();
        return view('front.account.job.create',[
            'categories' => $categories,
            'jobTypes' => $jobTypes
        ]);

    }


    public function saveJob(Request $request) {

        $rules = [
            'title' => 'required|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()) {

            $jobs = new Job();
            $jobs->title = $request->title;
            $jobs->category_id = $request->category;
            $jobs->job_type_id = $request->jobType;
            $jobs->user_id = Auth::user()->id;
            $jobs->vacancy = $request->vacancy;
            $jobs->salery = $request->salary;
            $jobs->location = $request->location;
            $jobs->description = $request->description;
            $jobs->benefits = $request->benefits;
            $jobs->responsibility = $request->responsibility;
            $jobs->qualification = $request->qualifications;
            $jobs->keyword = $request->keywords;
            $jobs->experience = $request->experience;
            $jobs->company_name = $request->company_name;
            $jobs->company_location = $request->company_location;
            $jobs->company_website = $request->company_website;
            $jobs->save();


            session()->flash('success', 'Job added successfully');      

            return response()->json([
                'status' => true,
                'message' => 'Job added successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function myJobs(){
        $jobs = Job::where('user_id',Auth::user()->id)->with('jobType')->orderBy('created_at','DESC')->paginate(10);

       return view('front.account.job.my-jobs',[
        'jobs' => $jobs
       ]);
    }

    public function editJob(Request $request, string $id) {
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();

        $jobTypes = JobType::orderBy('name','ASC')->where('status',1)->get();

        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $id,
        ])->first();

        if($job == null) {
            abort(404);
        }


        return view('front.account.job.edit',[
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'job' => $job 
        ]);
    }




    public function updateJob(Request $request, string $id) {

        $rules = [
            'title' => 'required|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'company_name' => 'required|max:100',
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()) {

            $jobs = Job::find($id);
            $jobs->title = $request->title;
            $jobs->category_id = $request->category;
            $jobs->job_type_id = $request->jobType;
            $jobs->user_id = Auth::user()->id;
            $jobs->vacancy = $request->vacancy;
            $jobs->salery = $request->salary;
            $jobs->location = $request->location;
            $jobs->description = $request->description;
            $jobs->benefits = $request->benefits;
            $jobs->responsibility = $request->responsibility;
            $jobs->qualification = $request->qualifications;
            $jobs->keyword = $request->keywords;
            $jobs->experience = $request->experience;
            $jobs->company_name = $request->company_name;
            $jobs->company_location = $request->company_location;
            $jobs->company_website = $request->company_website;
            $jobs->save();


            session()->flash('success', 'Job Updated successfully');      

            return response()->json([
                'status' => true,
                'message' => 'Job Updated successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function deleteJob(Request $request) {
        $job = Job::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId
        ])->first();

   

        if($job == null) {
            session()->flash('errors', 'Either job deleted or not found.');
            return response()->json([
              'status' => true,
              
            ]);

        }

        Job::where('id',$request->jobId)->delete();

        session()->flash('success', 'Job deleted successfully.');
        return response()->json([
          'status' => true,
          
        ]);

    }

    public function myJobApplications() {
       $jobApplications = JobApplication::where('user_id',Auth::user()->id)
                    ->with(['job','job.jobType','job.applications'])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
       
        return view('front.account.job.my-job-applications',[
            'jobApplications' => $jobApplications
        ]);
      }



      public function removeJobs(Request $request) {
         $jobApplications = JobApplication::where(['id'=>$request->id, 
                            'user_id' => Auth::user()->id])
                             ->first();

         if($jobApplications == null) {
            session()->flash('error', 'Job Application not Found');
            return response()->json([
                'status' => false,
            ]);
         }


         JobApplication::find($request->id)->delete();

         session()->flash('success', 'Job Application removed successfully');
         return response()->json([
            'status' => true,

         ]);
      }

      public function savedJobs() {

        $saveJobs = SavedJob::where(['user_id' => Auth::user()->id])
                    ->with(['job','job.jobType','job.applications'])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        
         return view('front.account.job.saved-jobs',[
             'saveJobs' => $saveJobs
         ]);


      }



      public function removeSaveJob(Request $request) {
        $savedJob = SavedJob::where(['id'=>$request->id, 
                           'user_id' => Auth::user()->id])->first();

        if($savedJob == null) {
           session()->flash('error', 'Job not Found');
           return response()->json([
               'status' => false,
           ]);
        }


        SavedJob::find($request->id)->delete();

        session()->flash('success', 'Job removed successfully');
        return response()->json([
           'status' => true,

        ]);
     }


     public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
              'old_password' => 'required',
              'new_password' => 'required',
              'confirm_password' => 'required|same:new_password'
        ]);

        if($validator->fails()) {
            return response()->json([
               'status' => false,
                'errors' => $validator->errors()
            ]);

        }
            if(Hash::check($request->old_password, Auth::user()->password) == false){
                session()->flash('error', 'Your old password is incorrect');
                return response()->json([
                    'status' => true,
                 ]);   
            }

            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();


            session()->flash('success', 'Password updated successfully');
            return response()->json([
                'status' => true,
             ]);

       

     }


  
 public function forgotPassword() {
  return view('front.account.forgot-password');
   
}

public function processForgotPassword(Request $request) {

    $validator = Validator::make($request->all(), [
         'email' => 'required|email|exists:users,email'
    ]);

    if($validator->fails()) {
        return redirect()->route('account.forgotPassword')->withInput()->withErrors($validator);
    }

    $token = Str::random(60);

    DB::table('password_reset_tokens')->where('email',$request->email)->delete();
    
    DB::table('password_reset_tokens')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => now()
    ]);


    // Send Email here
    $user = User::where('email', $request->email)->first();
       $mailData = [
            'token' => $token,
            'user' => $user,
            'subject' => 'You have requested to change your password'
            
       ];
        Mail::to($request->email)->send(new ResetPasswordEmail($mailData));

        return redirect()->route('account.forgotPassword')->with('success', 'Reset Password email has been sent to your inbox.');
}


public function resetPassword($tokenString) {
  $token = DB::table('password_reset_tokens')->where('token',$tokenString)->first();

  if($token == null) {
      return redirect()->route('account.forgotPassword')->with('error','Invalid token.');
  }

  return view('front.account.reset-password',[
    'tokenString' => $tokenString
  ]);
}


public function processResetPassword(Request $request) {

    $token = DB::table('password_reset_tokens')->where('token',$request->token)->first();


    if($token == null) {
     return redirect()->route('account.forgotPassword')->with('error','Invalid token.');
 }


    $validator = Validator::make($request->all(), [
        'new_password' => 'required',
        'confirm_password' => 'required|same:new_password'

   ]);


   if($validator->fails()) {
       return redirect()->route('account.resetPassword',$request->token)->withInput()->withErrors($validator);
   } 


   User::where('email',$token->email)->update([
       'password' => Hash::make($request->new_password)
   ]);

   return redirect()->route('account.login')->with('success','You have successfully changed your password');


}

}