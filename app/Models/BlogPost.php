<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    // WE USE THIS FOR USING CREATE METHOD FROM CONTROLLER
    // protected $fillable = [];

    use HasFactory; 

    protected $fillable = ["title", "content", "user_id"];


    // public function comments() {
    //     return $this->hasMany(Comment::class)->latest();
    // } 

    public function comments() {
        return $this->morphMany(Comment::class, "commentable")->latest();
    } 


    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function tags() {
    //     return $this->belongsToMany(Tag::class)->withTimestamps();
    // }

    public function tags() {
        return $this->morphToMany(Tag::class, "taggable")->withTimestamps();
    }

    // public function image() {
    //     return $this->hasOne(Image::class);
    // }

    public function image() {
        return $this->morphOne(Image::class, "imageable");
    }


    public function scopeFirstFivePosts(Builder $query) {
        return $query->orderBy('created_at', "asc")->take(5);
    }
    

    // WE USE THIS FOR DELETING RELATED MODEL
    // WE CALLED THIS MODEL EVENTS
    public static function boot() {
        parent::boot();

        static::deleting(function(BlogPost $blogPost) {
            $blogPost->image()->delete();
        });

        static::deleting(function(BlogPost $blogPost) {
            $blogPost->comments()->delete();
        });
    }
}
