<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use App\Models\Department;


class UserController extends Controller
{
    public function pendingUsers()
    {
        $pending_users = User::where('status', '=', 0)->get();
        return view('SuperAdmin.pages.pending_user', compact('pending_users'));
    }


    //approving user based on id
    public function approveUser($id)
    {
        User::where('id', $id)->update(['status' => true]);
        return redirect()->back();
    }


    //all teachers for Super Admin
    public function allTeacher()
    {
        $teachers = User::where('role', '=', 'Teacher')->orWhere('role', '=', 'Admin')->get();
        return view('SuperAdmin.pages.teacher.all_teacher', compact('teachers'));
    }
    //make admin from teacher
    public function makeAdmin($id)
    {
        User::where('id', $id)->update(['role' => 'Admin']);
        return redirect()->back();
    }

    //all students
    public function allStudents()
    {
        $students = User::where('role', '=', 'Student')->get();
        return view('SuperAdmin.pages.student.all_student', compact('students'));
    }




    //all teachers for Department Admin
    public function allDepartmentTeacher()
    {
        $userEmail = Session::get('user_email');
        //dd($userEmail);
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        //dd($userDep);
        $sameDepartmentTeachers = User::where('department', '=', $userDep)->where('role', '=', 'Teacher')->orWhere('role', '=', 'Admin')->where('department', '=', $userDep)->get();
         //dd($students);
         
        //$teachers = User::where('role', '=', 'Teacher')->orWhere('role', '=', 'Admin')->get();
        return view('SuperAdmin.pages.teacher.all_teacher', compact('sameDepartmentTeachers'));
    }

    //all students
    public function allDepartmentStudents()
    {
        $userEmail = Session::get('user_email');
        //dd($userEmail);
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        //dd($userDep);
        $sameDepartmentStudents = User::where('department', '=', $userDep)->where('role', '=', 'Student')->get();
         //dd($students);
        
        $students = User::where('role', '=', 'Student')->get();
        return view('SuperAdmin.pages.student.all_student', compact('sameDepartmentStudents'));
    }
}