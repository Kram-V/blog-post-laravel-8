<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogPosts() {
        return $this->hasMany(BlogPost::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }


    public function commentsOn() {
        return $this->morphMany(Comment::class, "commentable")->latest();
    }

    public function image() {
        return $this->morphOne(Image::class, "imageable");
    }

    public function scopeMostBlogPosts(Builder $query) {
        return $query->withCount('blogPosts')->orderBy('blog_posts_count', "desc");
    } 

}
