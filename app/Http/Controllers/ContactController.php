<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactModel;
use App\Models\ContactForm;
use PhpParser\Node\Expr\AssignOp\Concat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{


    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }
    public function AddContact()
    {
        return view('.admin.contact.create');
    }
    public function StoreContact(Request $request)
    {
            Contact::insert([
            'email' => $request->email,
            'phone' =>  $request->phone,
            'address' =>  $request->address,
            'created_at' => Carbon::now()   
            ]);
            return  Redirect()->route('admin.contact')->with('success','Contact Info Successfully Added');
    }
    public function EditContact($id)
    {           
                $contacts = Contact::find($id);
                return view('admin.contact.edit',compact('contacts'));   
               
    }
    public function UpdateContact(Request $request,$id)
    {
                Contact::find($id)->update([
                'email' => $request->email,
                'phone' =>  $request->phone,
                'address' =>  $request->address,
                'updated_at' => Carbon::now()  
              
            ]);
            // dd($id);
            return  Redirect()->route('admin.contact')->with('success','Contact Info Successfully updated');
        
    }
    public function DeleteContact($id)
    {
        Contact::find($id)->delete();
        return  Redirect()->route('admin.contact')->with('success','Contact Info Successfully Updated');
    }
    public function Contact()
    {
        $contact = DB::table('contacts')->first();
        return view('pages.contact',compact('contact'));
    }
    public function ContactForm(Request $request)
    {
            ContactForm::insert([
            'name' => $request->name,
            'email' =>  $request->email,
            'subject' =>  $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()   
            ]);
            return  Redirect()->route('contact')->with('success','Message has been sent successfully');
    }
    public function AdminMessage()
    {
        $messages = ContactForm::latest()->paginate(3);
        return view('admin.contact.message',compact('messages'));
    }

    public function MessageDelete($id)
    {
        ContactForm::find($id)->delete();
        return  Redirect()->route('admin.message')->with('success','Message Successfully deleted');
    }

















//     public function __construct(){
//         $this-> middleware('auth');
//     }
//    public function index(){
//        return view('contact');
//    }
}
