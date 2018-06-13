<?php

namespace App\Http\Controllers;

use Session;
use App\Contact;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $contacts = DB::table('contacts')->leftJoin('customers','contacts.customer_id', '=',  'customers.customer_id')->select('customers.*',  'contacts.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_contacts')->with(['user'=> $user,'admins'=> $admins, 'contacts'=> $contacts]);

    }

    

    public function updateAdmin(Request $request)
    {
        $contact = Contact::where('id', $request->input('id'))->first();

        $contact->in_charge = $request->input('in_charge');

        if($contact->save()){
            Session::flash('success', $contact->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $contact = Contact::where('id', $request->input('id'))->first();

        $contact->status = $request->input('status');

        if($contact->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }


}
