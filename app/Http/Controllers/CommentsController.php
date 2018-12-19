<?php

namespace App\Http\Controllers;

use Session;
use App\Comment;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($table, $id)
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        if($table == "luxury_experiences"){
            $comments = DB::table('comments')->where('tab', $table)->leftJoin($table,'comments.details_id', '=',  $table.'.experience_id')->select($table.'.*',  'comments.*')->get()->toArray();
        }else{
            $comments = DB::table('comments')->where('tab', $table)->get()->toArray();
        }
        $admins = Admin::all();
        return view('admin_comments')->with(['user'=> $user, 'comments'=> $comments, 'id'=> $id, 'table'=> $table]);

    }

    

    
    public function postComment(Request $request)
    {
        $comment = new Comment;
        $comment->post = $request->input('post');
        $comment->details_id = $request->input('id');
        $comment->tab = $request->input('table');
        $comment->poster = $request->input('name');
        

        if($comment->save()){
            Session::flash('success', 'Comment has been saved');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not save comment');
            return back();
        }  

    }


}
