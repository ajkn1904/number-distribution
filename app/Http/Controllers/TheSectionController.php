<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TheSection;
use Session;
use App\Models\Department;
use App\Models\DepartmentSession;

class TheSectionController extends Controller
{
    public function createSection()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        //dd($userDep);
        $departments = Department::where('name', '=', $userDep)->get();
        $sessions = DepartmentSession::where('department', '=', $userDep)->where('status', '=', 1)->get();
        $courses = Courses::where('department', '=', $userDep)->get();

        return view('DepartmentAdmin.pages.sections.create', compact('departments', 'sessions', 'courses'));
    }



    public function sectionCreate(Request $req)
    {
        if($req->section && $req->session_id && $req->department_id && $req->course_id) {
            
            $section_exists =  TheSection::where('section', '=', $req->section)->where('session_id', '=', $req->session_id)->where('course_id', '=', $req->course_id)->first();
            if($section_exists) {
                return redirect()->back()->with('error', 'Section Already Exists!');
            } else {
                $section = new TheSection();
                $section->section = $req->section;
                $section->session_id = $req->session_id;
                $section->course_id = $req->course_id;
                $section->department_id = $req->department_id;
                if($section->save()) {
                    return redirect()->back()->with('success', 'Section Added');
                }

            }
        } else {
            return redirect()->back()->with('error', 'Data missing!');
        }
    }


    //all session
    public function allSection()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDepartmentName = $user->department;
        
        $department = Department::where('name', '=', $userDepartmentName)->first();

        
        $departmentId = Department::where('name', '=', $userDepartmentName)->first();
        $userDepartmentId = $departmentId->id;
        
        $sections = TheSection::where('department_id', '=', $userDepartmentId)->get();
        

        $sessionIds = $sections->pluck('session_id'); // Get an array of session IDs from sections
        $session = DepartmentSession::where('department', '=', $userDepartmentName)->whereIn('id', $sessionIds)->get(); // Retrieve sessions using the session IDs
        //dd($session);


        $courseIds = $sections->pluck('course_id'); // Get an array of course IDs from sections
        //dd($courseIds);
        $courses = Courses::whereIn('id', $courseIds)->get(); // Retrieve courses using the course IDs
        //dd($courses);


        $teacherIds = $sections->pluck('teacher_id'); // Get an array of teacher IDs from sections
        //dd($teacherIds);
        $teachers = User::whereIn('id', $teacherIds)->get();
        
        return view('DepartmentAdmin.pages.sections.all', compact('sections', 'department', 'session', 'courses', 'teachers'));
    }


    //edit function
    public function assignTeacher($id)
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        
        $teachers = User::where('department', '=', $userDep)->where('role', '=', 'Teacher')->get();
        $sections = TheSection::find($id); 
        return view('DepartmentAdmin.pages.sections.assign_teacher', compact('teachers', 'sections'));
    }


    //update function
    public function courseTeacher(Request $request, $id)
    {
        $obj = TheSection::find($id);
        $obj->teacher_id = $request->teacher_id;
        $obj->status = true;
        if($obj->save()) {
            return redirect('/section/all-section');
        }
    }
}