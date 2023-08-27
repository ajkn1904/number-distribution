<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\DepartmentSession;
use App\Models\Department;
use App\Models\User;

use function Laravel\Prompts\alert;

class DepartmentSessionController extends Controller
{
    //create session by Admin
    public function createSessions()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;
        //dd($userDep);
        $departments = Department::where('name', '=', $userDep)->get();

        return view('DepartmentAdmin.pages.sessions.create', compact('departments'));
    }



    public function sessionsCreate(Request $req)
    {
        if($req->name && $req->department && $req->duration) {
            $session_exists =  DepartmentSession::where('name', '=', $req->name)->first();
            if($session_exists) {
                return redirect()->back()->with('error', 'Session Already Exists!');
            } else {
                $session = new DepartmentSession();
                $session->name = $req->name;
                $session->duration = $req->duration;
                $session->department = $req->department;

                if($session->save()) {
                    return redirect()->back()->with('success', 'Session Added');
                }

            }
        } else {
            return redirect()->back()->with('error', 'Data missing!');
        }
    }


    //all session
    public function allSessions()
    {
        $userEmail = Session::get('user_email');
        $user = User::where('email', '=', $userEmail)->first();
        $userDep = $user->department;

        $session = DepartmentSession::where('department', '=', $userDep)->get();
        return view('DepartmentAdmin.pages.sessions.all', compact('session'));
    }


    //edit function
    public function edit($id)
    {
        $session = DepartmentSession::find($id);
        return view('DepartmentAdmin.pages.sessions.edit', compact('session'));
    }


    //update function
    public function update(Request $request, $id)
    {
        $obj = DepartmentSession::find($id);
        $obj->name = $request->name;
        $obj->duration = $request->duration;
        if($obj->save()) {
            return redirect('/session/all-session');
        }
    }



    //edit status=expire
    public function expire($id)
    {
        DepartmentSession::where('id', $id)->update(['status' => false]);
        return redirect()->back();
    }
    //edit status=running
    public function running($id)
    {
        DepartmentSession::where('id', $id)->update(['status' => true]);
        return redirect()->back();
    }


    //delete function
    public function sessionDelete($id)
    {
        if(DepartmentSession::find($id) -> delete()) {
            return redirect('/session/all-session');
        }
    }
}