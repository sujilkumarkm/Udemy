<?php

namespace App\Http\Controllers;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;
use App\Models\multpic;
use Intervention\Image\ImageManager;   
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
use App\Http\Requests\StoreImgRequest;


use Illuminate\Http\Request;

class MultiController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
    }
    public function Multip(){

        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }
    public function StoreImg(Request $request){

    $image = $request->file('image');

    foreach($image as $multi_image)
    {
        $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
        $path = public_path('image/multi/');
        $combined_path =  ($path.$name_gen);
        //dd($combined_path);
        Image::make($multi_image)->resize(300,200)->save($combined_path);
    
        $last_image = '/image/multi/'.$name_gen;
        //dd($path);
        // dd($name_gen);
        Multipic::insert([
            'image' => $last_image  ,
            'created_at' => Carbon::now()   
        ]);
    } //End of Foreach Loop
    return  Redirect()->back()->with('success','Successfully added');
    }
}
