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
            //dd($section);
            $session = DepartmentSession::where('id', '=', $sessionId)->get();
            //dd($section);

            $enrolled = Enrollment::where('status', '=', 1)->get();

            $enrolledCourses = DB::table('enrollments')->join('department_sessions', 'department_sessions.id', 'enrollments.session_id')->select('enrollments.*', 'department_sessions.*')->get();
            //dd($enrolledCourses);


            return view('Student.pages.courses', compact('courses', 'section', 'session', 'sectionData', 'enrolledCourses', 'email'));
        } else {
            return redirect()->back()->with('error', 'Data missing!');
        }
    }

    public function store($id)
    {
        dd($id);
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
            $obj->section_id = $id;
            $obj->session_id = $courseData->session_id;
            $obj->course_id = $courseData->course_id;
            $obj->status = true;
            if($obj->save()) {
                return redirect()->back()->with('success', 'Course Enrolled');
            }
        }
    }



    public function getSections($id)
    {
        $sections = DB::table('the_sections')->where('session_id', '=', $id)->get();
        return response()->json([
            'sections' => $sections
        ]);
    }



    public function delete($id)
    {
        $email = Session::get('user_email');
        $data = TheSection::where('id', '=', $id)->first();
        $sectionName = $data->section;

        if(Enrollment::where('course_id', $data->course_id)->where('session_id', $data->session_id)->where('section', $sectionName)->where('email', $email)->delete()) {
            return redirect()->back();
        }
    }

    public function myCourses()
    {
        $email = Session::get('user_email');
        $enrolled = Enrollment::where('email', '=', $email)->get();
        //dd($enrolled);

        $courses = DB::table('enrollments')->join('courses', 'courses.id', 'enrollments.course_id')->join('the_sections', 'enrollments.section_id', '=', 'the_sections.id')->join('department_sessions', 'enrollments.session_id', '=', 'department_sessions.id')->select('enrollments.*', 'courses.*', 'department_sessions.name')->where('enrollments.email', '=', $email)->get();
        //dd($courses);

        return view('Student.pages.my_courses', compact('courses'));
    }

    

}