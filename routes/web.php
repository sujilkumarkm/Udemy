<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MultiController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePass;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home', compact('brands','abouts','images'));
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});

// Route::get('contact','ContactController@index');
Route::get('/admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('admin/add/contact',[ContactController::class,'AddContact'])->name('add.contact');
Route::post('admin/store/contact',[ContactController::class,'StoreContact'])->name('store.contact');
Route::get('/admin/edit/{id}',[ContactController::class,'EditContact']);
Route::post('/admin/update/{id}',[ContactController::class,'UpdateContact']);
Route::get('/admin/delete/{id}',[ContactController::class,'DeleteContact']);
Route::get('/admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');
Route::get('/admin/delete/{id}',[ContactController::class,'MessageDelete']);



//Home Contact Page
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'ContactForm'])->name('contact.form');







//Category Controller
Route::get('/categories/all',[CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']);
Route::post('/category/update/{id}',[CategoryController::class,'Update']);
Route::get('softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('category/restore/{id}',[CategoryController::class,'Restore']);    
Route::get('category/pdelete/{id}',[CategoryController::class,'Pdelete']);   

//for brand route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']);
Route::post('/brand/update/{id}',[BrandController::class,'Update']);
Route::get('brand/delete/{id}',[BrandController::class,'Delete']); 

//Multi Image
Route::get('/multi/image',[MultiController::class,'Multip'])->name('multi.image');
Route::post('/multi/add',[MultiController::class,'StoreImg'])->name('store.image');



Route::get('/charity', function () {
    return view('charity');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    // $users = User::all();
    // $users = DB::table('users')->get();
    // return view('dashboard',compact('users'));
    return view('admin.index');


})->name('dashboard');

Route::get('/user/logout',[BrandController::class,'Logout'])->name('user.logout');


//Admin All Route
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('admin.slider.index');
Route::get('/add/slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::get('/slider/edit/{id}',[HomeController::class,'EditSlider']);
Route::post('/store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');   
Route::post('/slider/update/{id}',[HomeController::class,'Update']);
Route::get('slider/delete/{id}',[HomeController::class,'Delete']); 

//Home About All Routes
Route::get('home/about',[AboutController::class,'HomeAbout'])->name('home.about'); 
Route::get('/add/about',[AboutController::class,'AddAbout'])->name('add.about');
Route::post('/store/about',[AboutController::class,'StoreAbout'])->name('store.about'); 
Route::get('/about/edit/{id}',[AboutController::class,'EditAbout']);
Route::post('/about/update/{id}',[AboutController::class,'UpdateAbout']);
Route::get('/about/delete/{id}',[AboutController::class,'AboutDelete']); 


//Portfolio Page Route
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio'); 


 //Chnange Password and User Profile Route
 Route::get('/user/password',[ChangePass::class, 'CPassword'])->name('change.password');
 Route::post('/password/update',[ChangePass::class, 'UpdatePassword'])->name('password.update');


 //User Profile
 Route::get('/user/profile',[ProfileController::class, 'PUpdate'])->name('profile.update');
 Route::post('/user/profile/update',[ProfileController::class, 'UpdateProfile'])->name('update.user.profile');
