<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\StoreBrandRequest;
use Error;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\ImageManager;
use Image;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function AddSlider(){
        return view('admin.slider.create');
    }
    public function StoreSlider(Request $request){
        $ValidatedData = $request->validate([
            
            'title' => 'required|unique:sliders|min:10', 
            'description' => 'required|unique:sliders|min:20', 
            'image' => 'required|mimes:jpg,jpeg,png', 
        ],[
            'title.required' => 'Please input Slider Title', 
        ]
        );
    $slider_image = $request->file('image');
    $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
    $path = public_path('image/slider/');
    $combined_path =  ($path.$name_gen);
    //dd($combined_path);
    Image::make($slider_image)->resize(1920,1088)->save($combined_path);
  
    $last_image = '/image/slider/'.$name_gen;
    //dd($path);
    // dd($name_gen);
    Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $last_image  ,
        'created_at' => Carbon::now() ,  
    ]);

    return  Redirect()->route('admin.slider.index')->with('success','Slider Successfully added');
    }

    public function EditSlider($id){
        $sliders = Slider::find($id);
        return view('admin.slider.edit',compact('sliders')); 
    }


    public function Update(Request $request,$id)
    {
          
          $old_image = $request->old_image;
          
          $slider_image = $request->file('image');
          //dd($$request->brand_name);
         
          $get_up_location = $slider_image->move(public_path('image/slider/'), 
          $transformImage = $this->changeImage($request,$slider_image));
  
  
          $imagePath = '/image/slider/'.$transformImage;
           
  
          //unlink
          $path = public_path('');  
          $full_opath = $path.$old_image;
          unlink($full_opath);
    
          if($this->upBrand($request,$imagePath,$id))
          {
              return Redirect()->back()->with('success', 'Success');
          }else
          {
              return Redirect()->back()->with('error', 'Failed');
          }
              
      }
      public function upBrand(Request $request,$imagePath,$id)
      {
              Slider::find($id)->update([
              'title' => $request->title,
              'image' => $imagePath,
              'updated_at' => Carbon::now()   
              ]);
  
              return Redirect()->back()->with('success', 'Brand inserted successfully');
      }
      public function changeImage(Request $request, $slider_image)
          {    
              $name_gen = hexdec(uniqid());
              $img_ext = strtolower($slider_image->getClientOriginalExtension());
              $img_name = $name_gen.'.'.$img_ext;
      
              return $img_name;
          }
          public function Delete($id){


            $image = Slider::find($id);
            $folder = $image->image;
            $path = public_path('');
            $new_folder = $path.''.$folder;
            //dd($new_folder);
            unlink($new_folder);
            Slider::find($id)->delete();
            if('success')
            {
                return Redirect()->back()->with('success','Slider Deleted Successfully');
            }
            else
            {
                return Redirect()->back()->with('error','Slider Deleted Successfully');
            }
        }
        

            //return  Redirect()->route('admin.slider.index')->with('success','Slider Successfully updated');
}