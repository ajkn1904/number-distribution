<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function pendingUsers(){
        $pending_users = User::where('status', '=', 0)->get();
        return view('SuperAdmin.pages.pending_user', compact('pending_users'));
    }


    //approving user based on id
    public function approveUser($id){
        User::where('id', $id)->update(['status' => true]);
        return redirect()->back();
    }
}