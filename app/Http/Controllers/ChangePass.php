<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function CPassword(){
        return view('admin.body.chnage_password');
    }
    public function UpdatePassword(Request $request)
    {
        $ValidateData = $request->validate([
            'oldpassword' => 'required' ,
            'password' =>  'required | confirmed' ,
        ]);
            $hashedPassword = Auth::user()->password;
            if(Hash::check($request->oldpassword,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();

                    return redirect()->route('login')->with('success','Password changed successfully');
            }
            else
            {
                    return redirect()->back()->with('error','Current Password is invalid');
            }            
    }
}
