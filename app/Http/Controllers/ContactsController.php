<?php

namespace App\Http\Controllers;

use Mail;
use Session;
use App\Contact;
use App\TicketComment;
use App\Customer;
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

        $contacts = DB::table('contacts')->leftJoin('customers','contacts.email', '=',  'customers.email')->select('customers.*',  'contacts.*')->get()->toArray();

        $customer = Customer::all();
		
        $admins = Admin::all();
        
        return view('admin_contacts')->with(['user'=> $user,'admins'=> $admins, 'contacts'=> $contacts, 'customers' => $customer]);

    }

    public function updateAdmin(Request $request)
    {
        $contact = Contact::where('ticket_id', $request->input('id'))->first();

        $contact->in_charge = $request->input('in_charge');

        $contact->status = 'In Progress';

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
        $contact = Contact::where('ticket_id', $request->input('id'))->first();

        $contact->status = $request->input('status');

        if($contact->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function newTicket(Request $request)
    {
        $ticket = new Contact;

        $ticket_id = strtoupper(str_random(10));

        $ticket->ticket_id = $ticket_id;

        $ticket->email = $request->input('email');

        $ticket->title = $request->input('title');

        $ticket->message = $request->input('message');

        $ticket->status = 'Pending';

        $avatar = $request->file('avatar'); 
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $ticket->image1 = $path;

        if($ticket->save()){

            $data = [
                'email'=> $request->input('email'),
                'ticket_id' => $ticket_id,
                'date' =>date('Y-m-d')
                ];
     
                Mail::send('emails.ticket', $data, function($message) use($data){
                    
                    $message->from('noreply@theaffinityclub.com', 'TheAffinityClub');
                    $message->SMTPDebug = 4; 
                    $message->to($data['email']);
                    $message->subject('Ticket Notification');
                    
                });

            Session::flash('success', 'New Ticket has been Created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Ticket Could not be Created');
            return back();
        }
    }

    public function showTicket($id)
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        // $ticket = Contact::where('ticket_id', $id)->first();

        $ticket = DB::table('contacts')->leftJoin('customers','contacts.email', '=',  'customers.email')
        ->where('contacts.ticket_id', $id)
        ->select('customers.*',  'contacts.*')
        ->get()->first();

        $ticket_comment = TicketComment::where('ticket_id', $id)->get();

        return view('admin_reply_ticket')->with(['user'=> $user, 'ticket'=> $ticket, 'ticket_comment' => $ticket_comment]);
    }

    public function CommentTicket(Request $request)
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        // $contacts = DB::table('contacts')->leftJoin('customers','contacts.email', '=',  'customers.email')->select('customers.*',  'contacts.*')->get()->toArray();

        // $customer = Customer::all();
		
        // $admins = Admin::all();

       $comment = new TicketComment;

       $comment->ticket_id = $request->input('ticket_id');

       $comment->in_charge = $request->input('in_charge');

       $comment->post = $request->input('post');

       if($comment->save()){
            $data = [
            'email'=> $request->input('email'),
            'ticket_id' => $request->input('ticket_id'),
            'comment' => $request->input('post'),
            'date' =>date('Y-m-d')
            ];
 
            Mail::send('emails.ticket_comment', $data, function($message) use($data){
                
                $message->from('noreply@theaffinityclub.com', 'TheAffinityClub');
                $message->SMTPDebug = 4; 
                $message->to($data['email']);
                $message->subject('Ticket Notification');
                
            });
            Session::flash('success', 'Comment Sent Successfully');
            return back();
        }
        else{
            Session::flash('error', 'An error occured. ');
            return back();
        }
        

    }

    public function saveTicket(Request $request)
    {
        $ticket = new Contact;

        $ticket_id = strtoupper(str_random(10));

        $firstname = $request->input('firstname');

        $ticket->ticket_id = $ticket_id;

        $ticket->email = $request->input('email');

        $ticket->title = $request->input('title');

        $ticket->message = $request->input('message');

        $ticket->status = 'Pending';

        if ($ticket->save()) {
            //code to send mail comes here
                $data = [
                'email'=> $request->input('email'),
                'ticket_id' => $ticket_id,
                'firstname' => $request->input('firstname'),
                ];
     
                Mail::send('emails.contact', $data, function($message) use($data){
                    
                    $message->from('noreply@theaffinityclub.com', 'TheAffinityClub');
                    $message->SMTPDebug = 4; 
                    $message->to($data['email']);
                    $message->subject('Ticket Notification');
                    
                });


            return response()->json([
                'error' => false,
                'message' => 'success'
            ]);
            
        }else {
            return response()->json([
                'error' => true,
                'message' => 'Mail Failed'
            ]);
        }
    }

}
