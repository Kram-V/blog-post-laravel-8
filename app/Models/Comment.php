<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory; 

    protected $fillable = ["content", "user_id"];

    // YOU CAN USE THIS FORMAT FOR CHANGING THE NAME OF FUNCTION
    // public function blog_post() {
    //     return $this->belongsTo(BlogPost::class, "blog_post_id");
    // }
    // public function blogPost() {
    //     return $this->belongsTo(BlogPost::class);
    // }  

    public function commentable() {
        return $this->morphTo();
    }  

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->morphToMany(Tag::class, "taggable")->withTimestamps();
    }
}
