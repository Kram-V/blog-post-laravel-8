<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware("auth")->only(["show", "edit", "update"]);
        // "user" IS CAME FROM THE URL VARIABLE {user}
        $this->authorizeResource(User::class, "user");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("users.show", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("users.edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => "required",
            "avatar" => "image|mimes:png,jpg,jpeg"
        ]);

        if($request->hasFile("avatar")) {
            $path = $request->file("avatar")->store("avatars");

            if ($user->image) {
                File::delete("storage/" . $user->image->path);
                $user->image->path = $path;
                $user->image->save();
            } else {
                $user->image()->save(
                    Image::make(["path" => $path])
                );
            }
        }

        $user->name = $request->name;
        $user->save();

        $request->session()->flash("status", "The user was updated");

        return redirect()->route("users.show", ["user" => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
