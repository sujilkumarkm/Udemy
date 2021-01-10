<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
     public function AllCat()
     {
         //Option 1 Getting Data without any sort
        //  $categories = Category::all();

        //Option 2 Elequent ORM
        //  $categories = Category::latest()->get();
         $categories = Category::latest()->paginate(5);
         $trachCat = Category::onlyTrashed() -> latest()-> paginate(3);

        //Option 3 Using Query Builder
        // $categories = DB::table('categories')->latest()->paginate(5); 
        // $categories = DB::table('categories')->join('users','categories.user_id', 'users.id') 
        // ->select('categories.*', 'users.name')-> latest()->paginate(5); 

         return view('admin.category.index', compact('categories','trachCat'));



     }
     public function AddCat(Request $request)
     {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please input category name',
        ]
    
    );

    //Method 1 Insert Data into database

    Category::insert([
        'category_name' => $request->category_name, 
        'user_id' => Auth::user()->id, 
        'created_at' => Carbon::now()
    ]);

        
    //Method 2 Option 2 here no need to manually add now() for created_at part.
            // $category = new Category;
            // $category->category_name = $request-> category_name;
            // $category->user_id = Auth::user()->id;
            // $category-> save();


    //Method 3 Using Query Builder
    // $data = array();
    // $data['category_name'] = $request -> category_name;
    // $data['user_id'] = Auth::user()->id;
    // DB::table('categories')-> insert($data);



        return Redirect()->back()->with('success', 'Category inserted successfully');
     }

     Public function Edit($id){

        //Method 1 Elequent ORM
         $categories = Category::find($id);

        //Method2 Query Builder
        // $categories = DB::table('categories')-> where('id',$id)->first();
         return view('admin.category.edit',compact('categories'));

     }

     public function Update(Request $request, $id){

        //Method 1 Using Elequent ORM
        //  $update = Category::find($id) -> update([
        //      'category_name'=>$request -> category_name,
        //      'user_id'=>Auth::user()->id 
        //  ]);

        //Method 2 Using Query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories') -> where ('id',$id) -> update($data);

         return Redirect()->route('all.category')->with('success', 'Category updated successfully');
     }
     public function softDelete($id){
         $delete = Category::find($id)->delete();
         return Redirect()->back()->with('success','Category Soft Deleted Successfully');   
     }

     public function Restore($id){
         $delete = Category::withTrashed()->find($id)->restore();
         return Redirect()->back()->with('success','Restored Successfully');   
     }
     public function Pdelete($id){
         $delete = Category::onlyTrashed()->find($id)->forceDelete();
         return Redirect()->back()->with('success','Category Permanently deleted');   
     }
  
}
