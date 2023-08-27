<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Courses;
use Session;
use App\Models\Department;

class CourseController extends Controller
{
    //create courses by Admin
    public function createCourses()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        //dd($userDep);
        $departments = Department::where('name', '=', $userDep)->get();

        return view('DepartmentAdmin.pages.courses.create', compact('departments'));
    }


    
    public function coursesCreate(Request $req)
    {
        $course_exists =  Courses::where('name', '=', $req->name)->first();
        if($course_exists) {
            return redirect()->back()->with('error', 'Course Already Exists!');
        } else {
            $course = new Courses();
            $course->name = $req->name;
            $course->course_code = $req->course_code;
            $course->type = $req->courseType;
            $course->credit = $req->credit;
            $course->department = $req->departmentName;
            if($course->save()) {
                return redirect()->back()->with('success', 'Course Added');
            }

        }
    }


    //all courses
    public function allCourses()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        
        $courses = Courses::where('department', '=', $userDep)->get();
        return view('DepartmentAdmin.pages.courses.all', compact('courses'));
    }


     //edit function
     public function edit($id)
     {
         $course = Courses::find($id); 
         return view('DepartmentAdmin.pages.courses.edit', compact('course'));
     }
 
 
     //update function
     public function update(Request $request, $id)
     {
         $obj = Courses::find($id); 
         $obj->name = $request->name;
         $obj->course_code = $request->course_code;
         $obj->credit = $request->credit;
         $obj->type = $request->type;
         if($obj->save()) {
             return redirect('/courses/all-courses');
         }
     }
 
 
     //delete function
     public function courseDelete($id)
     {
         if(Courses::find($id) -> delete()) {
             return redirect('/courses/all-courses');
         }
     }
}