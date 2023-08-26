<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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


    //all teachers
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
}