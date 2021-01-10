<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreBrandRequest;
use Exception;
use GrahamCampbell\ResultType\Success;

class BrandController extends Controller
{
    public function AllBrand(){
    
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index',compact('brands'));
    }
    public function StoreBrand(StoreBrandRequest $request)
    {
        // Get file from request
        $getImg = $request->file('brand_image');

        // Move file to public path 
        $getImgPath = $getImg->move(public_path('image/brand/'), 

        // Transform the file's (img) name 
        $transformImage = $this->transformImageName($request,$getImg));
        

  
       $imagePath = '/image/brand/'.$transformImage;


       if($this->createImage($request,$imagePath))
        {
        return Redirect()->back()->with('success', 'Brand inserted successfully');
       }
       else {
           // Say something or send back with error. I didnt want to send an array, but ok
           return Redirect()->back()->with('error','Something went wrong');
       }
    }

    public function transformImageName(Request $request, $brand_image)
    {    
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;

        return $img_name;
    }

    public function createImage(Request $request,$imagePath)
    {
        $brand = Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $imagePath,
            'created_at' => Carbon::now()   
            ]);

            return true;
    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));

    }
    
    public function Update(Request $request,$id){
      $validatedData = $request->validate([
            'brand_name' => 'required|min:4', 
      ],
    
            [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand Longer than 4 Charectors',
        ]);

        $old_image = $request->old_image;
        
        $brand_image = $request->file('brand_image');
        //dd($$request->brand_name);
       
        $get_up_location = $brand_image->move(public_path('image/brand/'), 
        $transformImage = $this->changeImage($request,$brand_image));


        $imagePath = '/image/brand/'.$transformImage;
         

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
            Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $imagePath,
            'updated_at' => Carbon::now()   
            ]);

            return Redirect()->back()->with('success', 'Brand inserted successfully');
    }
    public function changeImage(Request $request, $brand_image)
        {    
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
    
            return $img_name;
        }

    public function Delete($id){


        $image = Brand::find($id);
        $folder = $image->brand_image;
        $path = public_path('');
        $new_folder = $path.''.$folder;
        //dd($new_folder);
        unlink($new_folder);
        Brand::find($id)->delete();
        return redirect()->back()->with('success','Brand Deleted Successfully');
    }
}
