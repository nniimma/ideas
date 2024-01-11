<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'bio',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
     * The attributes that should be cast.
     ! here hashes the pass:
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function ideas()
    {
        return $this->hasMany(Idea::class)->latest();
    }

    function comments()
    {
        return $this->hasMany(Comment::class);
    }

    function followings()
    {
        // ! belongs to many is for many to many relationsships
        // ! follower_user is our pivot table || pivot table is a table that save data of other tables inside it:
        // ! foreignPivotKey means us and relatedPivotKey is the one that we follow
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    function followers()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    function likes()
    {
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }
    // ! this function is to define if we like a post or not:
    function likesIdea(Idea $idea)
    {
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }

    // ! this function is to define if we follewed the user or not:
    function follows(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $this->name }}";
    }
}
