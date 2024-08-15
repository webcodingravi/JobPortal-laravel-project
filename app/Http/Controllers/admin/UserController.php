<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.users.list',[
            'users' => $users
        ]);
 
    }

    public function edit(string $id) {
        $user = User::find($id);
        return view('admin.users.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request, string $id) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id'
        ]);

        if($validator->passes()){
            $user = User::find($id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;
            $user->save();

           session()->flash('success', 'User information updated successfully');      
            return response()->json([
               'status' => true,
               'message' => 'User information updated successfully'
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

        $user = User::find($id);

        if($user == null) {
            session()->flash('error', 'User not found');
            return response()->json([
                 'status' => false,
            ]);
        }

        $user->delete();
        session()->flash('success', 'User deleted successfully');      
        return response()->json([
           'status' => true,
        ]);

      
    }

    }

