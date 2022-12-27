<?php

namespace App\Http\Controllers;

use App\Mail\CommentPosted;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

// THIS CONTROLLER IS RELATED FROM BLOGPOST INTO COMMENTS TABLE
class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    // MODEL BINDING (BlogPost)
    public function store(BlogPost $post, Request $request) {
        $request->validate([
            "content" => "required"
        ]);

        $comment = $post->comments()->create([
            "user_id" => Auth::user()->id,
            "content" => $request->content
        ]); 

        Mail::to($post->user->email)->send(
            new CommentPosted($comment)
        );

        // $request->session()->flash("status", "The comment was created");

        return back()->withStatus("The comment was created");
    }
}
