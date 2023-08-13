<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function login(){
    return view('SuperAdmin.pages.login');
}

/* public function registration(){
    return view('SuperAdmin.pages.registration');
}
     */



    //user login part
    public function userLogin(Request $req)
    {

        $email = $req->email;
        $password = md5($req->password);

        //checking data with database using where()
        $user = User::where('email', '=', $email)->where('password', '=', $password)->first();
        if($user) {
            // check if user is approved (check value of status column is 1)

            if($user->status == 1) {
                //saving user in the Session Class using put()
                Session::put('user_fname', $user->first_name);
                Session::put('user_lname', $user->last_name);
                Session::put('user_email', $user->email);
                Session::put('user_role', $user->role);

                return redirect('/dashboard');

            } else {
                return redirect()->back()->with('error', 'User Not Approved Yet...');

            }


        } else {
            return redirect()->back()->with('error', 'User Not Found with these credentials...');
        }
    }




    //registration part for teacher
    public function teacherRegister()
    {
        return view('SuperAdmin.pages.teacher_register');
    }
    public function registrationTeacher(Request $req)
    {
        if($req->password == $req->conf_password) {
            // Check if the submitted email is already in the User table or database
            //checking existing data on database using where()
            $user_exists =  User::where('email', '=', $req->email)->first();
            if($user_exists) {
                return redirect()->back()->with('error', 'Email Already Exists!');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->teacher_id = $req->roll;
                $user->department = $req->department;
                /* md5 to encrypt password */
                $user->password = md5($req->password);
                $user->role = 'Teacher';
                if($user->save()) {
                    return redirect()->back()->with('success', 'User Registered. Waiting for Admin Approval');
                }

            }

        } else {
            return redirect()->back()->with('error', 'Password Mismatch!');
        }

    }



    //registration part for student
    public function studentRegister()
    {
        return view('SuperAdmin.pages.student_register');
    }


    
    public function registrationStudent(Request $req)
    {
        if($req->password == $req->conf_password) {
            // Check if the submitted email is already in the User table or database
            //checking existing data on database using where()
            $user_exists =  User::where('email', '=', $req->email)->first();
            if($user_exists) {
                return redirect()->back()->with('error', 'Email Already Exists!');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->student_id = $req->roll;
                $user->department = $req->department;
                /* md5 to encrypt password */
                $user->password = md5($req->password);
                $user->role = 'Student';
                if($user->save()) {
                    return redirect()->back()->with('success', 'User Registered. Waiting for Admin Approval');
                }

            }

        } else {
            return redirect()->back()->with('error', 'Password Mismatch!');
        }
    }



    //user logout & delete all the Session data
    public function logout(Request $request)
    {
        $request->session()->forget(['user_fname','user_lname', 'user_email', 'user_role']);
        return redirect('/login');
    }


    

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email) ->first();
        if($user) {
            return redirect()->back()->with('error', 'Email Already Exists!');
        } else {
            $user = new User();
            $user->first_name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->role = 'Student';
            if($user->save()) {
                return redirect()->back()->with('success', 'User Registered. Waiting for Admin Approval');
            }


            Auth::login($user, true);


        }

    }
}