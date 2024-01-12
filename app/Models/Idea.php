<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // ? another way of using with() method:
    // todo: protected $with = ['user', 'comments.user'];
    // ! we can choose the columns that we want as well(without space between id and name):
    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $withCount = ['likes'];

    /*
    // the fillable is for being able to put the new values in the variable in the second method in dashboard controller (mass assigning and it has security problems)
    // to get rid of security issues it is better to only mass assign the ones that is validated
    ? the one in blue
    */
    protected $fillable = [
        'content',
        'user_id'
    ];

    // * oposite of fillable is guarded(it means I dont want mass assignment it):
    // protected $guarded = [
    //     'content',
    //     'likes'
    // ];

    // ! the name of the function should be the same as the name of the table for relationships(this is for getting all comments of each idea):
    // ! this relationship is one to many, it means each idea has many comments
    function comments()
    {
        // ! first parameter is the model, second one the foreignKey, and the third one is the local key
        // ! by default foreignKey in laravel is tableName_id and localKey is id
        return $this->hasMany(Comment::class, 'idea_id', 'id');
    }

    // ! a new relatioship to get the name of the user who put the comment:
    function user()
    {
        // ! we use belongs to because many ideas can belond to one user:
        return $this->belongsTo(User::class);
    }

    // ! if the pivot table was idea_user we wouldnt have to mention the table name but now that the pivot table's name is different we need to mention the table
    function likes()
    {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }
}
