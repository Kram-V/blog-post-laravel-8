<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    // MODEL BINDING (BlogPost)
    public function store(User $user, Request $request) {
        $request->validate([
            "content" => "required"
        ]);

        $user->commentsOn()->create([
            "user_id" => Auth::user()->id,
            "content" => $request->content
        ]); 

        // $request->session()->flash("status", "The comment was created");

        return back()->withStatus("The comment was created");
    }
}
