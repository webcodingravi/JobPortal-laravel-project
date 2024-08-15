<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
   public function index() {
    $jobs = Job::orderBy('id', 'DESC')->with(['user','applications'])->paginate(10);
    return view('admin.jobs.list', [
        'jobs' => $jobs
    ]);
   }

   public function edit(string $id) {
    $job = Job::findOrFail($id);

    $categories = Category::orderBy('name', 'ASC')->get();
    $jobTypes = JobType::orderBy('name', 'ASC')->get();

    return view('admin.jobs.edit',[
    'job' => $job,
    'categories' =>  $categories,
    'jobTypes' => $jobTypes
    ]);
   }


   public function update(Request $request, string $id) {

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
        $jobs->status = $request->status;
        $jobs->isFeatured = (!empty($request->isFeatured) ? $request->isFeatured : 0);



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

public function destroy(Request $request) {
 $id = $request->id;

 $job = Job::find($id);
 if($job == null){
    session()->flash('error', 'Either job deleted or not found.');
  return response()->json([
    'status' => false
  ]);
 }

 $job->delete();

 session()->flash('success', 'Job deleted successfully.');

 return response()->json([
    'status' => true,
]);


}
}
