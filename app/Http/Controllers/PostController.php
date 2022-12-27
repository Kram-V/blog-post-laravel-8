<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// IF WE WANT TO USE THE AuthServiceProvider.php AND USE THE GATE
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->only(["create", "store", "edit", "update", "destroy"],);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view("posts.index", ["posts" => BlogPost::withCount("comments")->with("tags", "user")->orderBy("created_at", "desc")->get(), 
        "first_five_posts" => BlogPost::firstFivePosts()->get(), 
        "most_active_users" => User::mostBlogPosts()->take(5)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:5|max:100",
            "content" => "required|min:10",
            "image" => "image|mimes:png,jpg,jpeg"
        ]);


        $post = new BlogPost();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;


        $post->save();

        if($request->hasFile("image")) {
            $path = $request->file("image")->store("files");

            $post->image()->save(
                // Image::create(["path" => $path])
                Image::make(["path" => $path])
            );
            
        

            // dump($file);
            // dump($file->getClientMimeType());
            // dump($file->getClientOriginalExtension());

            // THESE ARE THE SAME
            // $file->store("files");
            // dump(Storage::disk("public")->put("files", $file));

            // THESE ARE THE SAME
            // dump(Storage::putFileAs("files", $file, $post->id . "." . $file->guessExtension()));
            // $name = $file->storeAs("files", $post->id . "." . $file->guessExtension());
            // dump(Storage::url($name));
        }

        $request->session()->flash("status", "The blog post was created");

        return redirect()->route("posts.show", ["post" => $post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            // abort_if(!isset($this->posts[$id]), 404);

            return view("posts.show", ["post" => 
            // BlogPost::with(["comments" => function($query) {
            // return $query->latest();
            // }])
            BlogPost::with("comments", "user", "tags", "comments.user")
            // ->with("user")
            // ->with("tags")
            // ->with("comments.user")
            ->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies("update-post", $post)) {
        //     abort(403, "You cant edit this blog post!");
        // }

        // THIS IS SAME AS ABOVE
        $this->authorize("update", $post);

        return view("posts.edit", ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|min:5|max:100",
            "content" => "required|min:10",
            "image" => "image|mimes:png,jpg,jpeg"
        ]);

        $post = BlogPost::findOrFail($id);


        // if (Gate::denies("update-post", $post)) {
        //     abort(403, "You cant edit this blog post!");
        // }

        // THIS IS SAME AS ABOVE
        $this->authorize("update", $post);
      

        $post->title = $request->title;
        $post->content = $request->content;

        if($request->hasFile("image")) {
            $path = $request->file("image")->store("files");

            if ($post->image) {
                File::delete("storage/" . $post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(
                    // Image::create(["path" => $path])
                    Image::make(["path" => $path])
                );
            }

           
        

            // dump($file);
            // dump($file->getClientMimeType());
            // dump($file->getClientOriginalExtension());

            // THESE ARE THE SAME
            // $file->store("files");
            // dump(Storage::disk("public")->put("files", $file));

            // THESE ARE THE SAME
            // dump(Storage::putFileAs("files", $file, $post->id . "." . $file->guessExtension()));
            // $name = $file->storeAs("files", $post->id . "." . $file->guessExtension());
            // dump(Storage::url($name));
        }

        $post->save();

        
        $request->session()->flash("status", "The blog post was updated");

        return redirect()->route("posts.show", ["post" => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id); 


        // if (Gate::denies("delete-post", $post)) {
        //     abort(403, "You cant delete this blog post!");
        // }

        // THIS IS SAME AS ABOVE
        $this->authorize("delete", $post);

        if ($post->image) {
            $path = storage_path("app/public/" . $post->image->path);

            File::delete($path);
        }
     
        $post->delete();

        session()->flash("status", "The blog post was deleted");

        return back();
    }
}
