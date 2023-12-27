<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // the fillable is for being able to put the new values in the variable in the second method in dashboard controller, the one in blue
    protected $fillable = [
        'content',
        'likes'
    ];
}
