<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{   
    public function PUpdate()
    {
        if(Auth::user())
        {
            $user = User::find(Auth::user()->id);
            if($user)
            {
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }
    public function UpdateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($user)
        {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            return Redirect()->back()->with('success','Profile updated successfully');
        }
        else
        {
            return Redirect()->back()->with('error','Updation failed');
        }
    }
}
