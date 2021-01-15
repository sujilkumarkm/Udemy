<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index', compact('homeabout'));
    }
    public function AddAbout(){
        return view('admin.home.create');
    }
    public function StoreAbout(Request $request)
    {
        $ValidatedData = $request->validate([
            
            'title' => 'required|unique:home_abouts|min:10', 
            'short_des' => 'required|unique:home_abouts|min:10', 
            'long_des' => 'required|unique:home_abouts|min:10', 
        ],[
            'title.required' => 'Please input About Title', 
        ]);
        HomeAbout::insert([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now(), 
        ]) ;
        return  Redirect()->route('home.about')->with('success','About Successfully added');
    }
    public function EditAbout($id){
        $abouts = HomeAbout::find($id);
        return view('admin.home.edit',compact('abouts'));      
    }
    public function UpdateAbout(Request $request,$id){
        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_des' =>  $request->short_des,
            'long_des' =>  $request->long_des,
            'updated_at' => Carbon::now()   
            ]);
            return  Redirect()->route('home.about')->with('success','About Successfully Updated');
    }
    public function AboutDelete($id){
        HomeAbout::find($id)->delete();
        return  Redirect()->route('home.about')->with('success','About Successfully Updated');
    }
    public function Portfolio(){
        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
