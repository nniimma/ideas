<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    /*
    // the fillable is for being able to put the new values in the variable in the second method in dashboard controller
    ? the one in blue
    */
    protected $fillable = [
        'content',
        'likes'
    ];

    // ! the name of the function should be the same as the name of the table for relationships(this is for getting all comments of each idea):
    // ! this relationship is one to many, it means each idea has many comments
    function comments()
    {
        // ! first parameter is the model, second one the foreignKey, and the third one is the local key
        // ! by default foreignKey in laravel is tableName_id and localKey is id
        return $this->hasMany(Comment::class, 'idea_id', 'id');
    }
}
