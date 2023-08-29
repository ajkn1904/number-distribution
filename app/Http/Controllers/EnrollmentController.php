<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TheSection;
use Session;
use App\Models\Department;
use App\Models\DepartmentSession;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function create()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;

        $department = Department::where('name', '=', $userDep)->first();
        $userDepartmentId = $department->id;

        $sessions = DepartmentSession::where('department', '=', $userDep)->where('status', '=', 1)->get();

        return view('Student.pages.create', compact('sessions'));
    }


    public function enrollCourse(Request $req)
    {
        if($req->section && $req->session_id) {
            $email = Session::get('user_email');
            $sectionData = TheSection::where('section', '=', $req->section)->where('session_id', '=', $req->session_id)->get();
            //dd($sectionData);

            $courseIds = $sectionData->pluck('course_id');
            //dd($courseIds);

            $courses = Courses::whereIn('id', $courseIds)->get();
            $section = $req->section;
            $sessionId = $req->session_id;
            //dd($courses);

            $session = DepartmentSession::where('id', '=', $sessionId)->get();
            //dd($section);

            $enrolled = Enrollment::where('status','=', 1)->get();

            return view('Student.pages.courses', compact('courses', 'section', 'session', 'sectionData', 'enrolled', 'email'));
        } else {
            return redirect()->back()->with('error', 'Data missing!');
        }
    }

    public function store($id)
    {
        $email = Session::get('user_email');

        $courseData =  TheSection::where('id', '=', $id)->first();
        //dd($courseData->session_id);
        //dd($courseData->course_id);
        $enroll_exists =  Enrollment::where('email', '=', $email)->where('section', '=', $courseData->section)->where('session_id', '=', $courseData->session_id)->where('course_id', '=', $courseData->course_id)->first();
        if($enroll_exists) {
            return redirect()->back()->with('error', 'Corse Already Enrolled!');
        } else {

            $obj = new Enrollment();
            $obj->email = $email;
            $obj->section = $courseData->section;
            $obj->session_id = $courseData->session_id;
            $obj->course_id = $courseData->course_id;
            $obj->status = true;
            if($obj->save()) {
                return redirect()->back()->with('success', 'Course Enrolled');
            }
        }
    }



    public function getSections($id){
        $sections = DB::table('the_sections')->where('session_id', '=', $id)->get();
        return response()->json([
            'sections' => $sections
        ]);
    }



    public function delete($id){
        $email = Session::get('user_email');
        $data = TheSection::where('id', '=', $id)->first();
        $sectionName = $data->section;

        if(Enrollment::where('course_id', $data->course_id)->where('session_id', $data->session_id)->where('section', $sectionName)->where('email', $email)->delete()) {
            return redirect()->back();
        }
    }

    public function myCourses(){
        $email = Session::get('user_email');
        $enrolled = Enrollment::where('email', '=', $email)->get();

        $courses = DB::table('enrollments')->join('courses', 'courses.id', 'enrollments.course_id')->select('enrollments.*', 'courses.*')->get();
        
        $sessionIds = $enrolled->pluck('session_id'); 
        $session = DepartmentSession::whereIn('id', $sessionIds)->first();
        //dd($session);
        
        return view('Student.pages.my_courses', compact('courses', 'session'));
    }

}



