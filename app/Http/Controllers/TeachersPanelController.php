<?php

namespace App\Http\Controllers;

use App\Models\AllocateMarks;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TheSection;
use Session;
use App\Models\Department;
use App\Models\DepartmentSession;
use App\Models\DistributeMarks;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class TeachersPanelController extends Controller
{
    public function myCourses()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;

        $department = Department::where('name', '=', $userDep)->first();
        $userDepartmentId = $department->id;

        $sessions = DepartmentSession::where('department', '=', $userDep)->where('status', '=', 1)->get();

        return view('Teachers.pages.Courses.session_selection', compact('sessions'));
    }


    public function show(Request $req)
    {
        if($req->session_id != null) {
            $userEmail = Session::get('user_email');
            $user = User::where('email', '=', $userEmail)->first();
            //dd($user->id);

            $courses = DB::table('courses')->join('the_sections', 'the_sections.course_id', 'courses.id')->join('department_sessions', 'department_sessions.id', 'the_sections.session_id')->where('the_sections.teacher_id', '=', $user->id)->where('department_sessions.status', '=', 1)->where('department_sessions.id', '=', $req->session_id)->select('courses.*', 'the_sections.*', 'department_sessions.name as session_name')->get();
            //dd($courses);


            $existedMarks = DB::table('distribute_marks')->join('the_sections', 'the_sections.id', 'distribute_marks.section_id')->select('the_sections.*', 'distribute_marks.*')->get();

            return view('Teachers.pages.Courses.my_courses', compact('courses', 'existedMarks'));

        } else {
            return redirect()->back()->with('error', 'Select a session');
        }
    }


    public function distribute($id)
    {

        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();

        $courses = DB::table('courses')->join('the_sections', 'the_sections.course_id', 'courses.id')->join('department_sessions', 'department_sessions.id', 'the_sections.session_id')->where('the_sections.teacher_id', '=', $user->id)->where('department_sessions.status', '=', 1)->where('the_sections.id', '=', $id)->select('courses.*', 'the_sections.*', 'department_sessions.name as session_name')->first();
        //dd($courses);

        return view('Teachers.pages.Marks.create', compact('courses'));
    }




    public function storeMarks(Request $req, $id)
    {
        $marks_exists =  DistributeMarks::where('section_id', '=', $id)->first();
        if($marks_exists) {
            return redirect()->back()->with('error', 'Marks already distributed!');
        } else {

            //dd($req->ct1 , $req->ct2 , $req->mid , $req->assessment , $req->attendance , $req->final_exam);
            if($req->ct1 && $req->ct2 && $req->mid && $req->assessment && $req->attendance && $req->final_exam) {
                $marks = new DistributeMarks();
                $marks->class_test_one = $req->ct1;
                $marks->class_test_two = $req->ct2;
                $marks->mid_term = $req->mid;
                $marks->assessment = $req->assessment;
                $marks->attendance = $req->attendance;
                $marks->final_exam = $req->final_exam;
                $marks->section_id = $id;
                if($marks->save()) {
                    //return redirect()->back()->with('success', 'Course Added');
                    return redirect()->back()->with('success', 'Course Added');
                }
            } else {
                return redirect()->back()->with('error', 'Data missing!');
            }

        }

    }



    //edit function
    public function edit($id)
    {
        $marks = DistributeMarks::where('section_id', $id)->first();
        //dd($marks);
        return view('Teachers.pages.Marks.redistribute', compact('marks'));
    }


    //update function
    public function update(Request $req, $id)
    {
        $marks = DistributeMarks::where('section_id', $id)->first();
        //dd($marks);
        $marks->class_test_one = $req->ct1;
        $marks->class_test_two = $req->ct2;
        $marks->mid_term = $req->mid;
        $marks->assessment = $req->assessment;
        $marks->attendance = $req->attendance;
        $marks->final_exam = $req->final_exam;
        $marks->section_id = $id;
        if($marks->save()) {
            return redirect()->back()->with('success', 'Successfully Updated');
        }

    }

    public function showDistribution($id)
    {
        $marks = DistributeMarks::where('section_id', $id)->get();
        //dd($marks->class_test_one);
        return view('Teachers.pages.Marks.show_distribution', compact('marks'));
    }


    //marks allocation
    public function marksAllocation($id)
    {
        $allocated = AllocateMarks::where('section_id', $id)->get();
        //dd($allocated);

        $section = TheSection::where('id', $id)->first();
        //dd($id, $section);
        $students = Enrollment::where('section_id', $section->id)->get();
        //dd($students);
        $marks = DistributeMarks::where('section_id', $id)->first();
        //dd($marks);
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        //dd($user);

        //dd($students);

        return view('Teachers.pages.Marks.allocation', compact('students', 'marks', 'allocated'));
    }


    public function storeStudentsMarks(Request $req, $id)
    {
    
        $students = Enrollment::where('id', $id)->first();
        //dd($students);
        $userInfo = User::where('email', $students->email)->first();
        //dd($userInfo);

        $existed_marks = AllocateMarks::where('enrollment_id', '=', $id)->first();;
        if($existed_marks) {

            $existed_marks->class_test_one = $req->ct1;
            $existed_marks->class_test_two = $req->ct2;
            $existed_marks->mid_term = $req->mid;
            $existed_marks->assessment = $req->assessment;
            $existed_marks->attendance = $req->attendance;
            $existed_marks->final_exam = $req->final_exam;
            if($existed_marks->save()) {
                return redirect()->back()->with('success', 'Marks Updated');
            } else {
                return redirect()->back()->with('error', 'Data missing!');
            }
        } else {
            if($req->ct1 || $req->ct2 || $req->mid || $req->assessment || $req->attendance || $req->final) {
                $marks = new AllocateMarks();
                $marks->email = $students->email;
                $marks->user_id = $userInfo->id;
                $marks->class_test_one = $req->ct1;
                $marks->class_test_two = $req->ct2;
                $marks->mid_term = $req->mid;
                $marks->assessment = $req->assessment;
                $marks->attendance = $req->attendance;
                $marks->final_exam = $req->final_exam;
                $marks->section_id = $students->section_id;
                $marks->session_id = $students->session_id;
                $marks->course_id = $students->course_id;
                $marks->enrollment_id = $id;
                if($marks->save()) {
                    //return redirect()->back()->with('success', 'Course Added');
                    return redirect()->back()->with('success', 'Marks Updated');
                }

            } else {
                return redirect()->back()->with('error', 'Data missing!');
            }
        }

    }

}