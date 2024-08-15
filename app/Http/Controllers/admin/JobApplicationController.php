<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Controllers\Controller;

class JobApplicationController extends Controller
{
    public function index() {
        $applications = JobApplication::orderBy('created_at', 'DESC')
        ->with(['job','user', 'employer'])->paginate(10);

        return view('admin.job-applications.list',[
           'applications' => $applications 
        ]);


    }

    public function destroy(Request $request) {
        $id = $request->id;

        $jobApplications = JobApplication::find($id);

        if($jobApplications == null) {
            session()->flash('error', 'Either Job Application deleted or not found');
            return response()->json([
                 'status' => false
            ]);
        }

        $jobApplications->delete();
        session()->flash('success', 'Job Application deleted successfully.');
        return response()->json([
             'status' => false
        ]);

    }
}
