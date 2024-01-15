<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;

class DashbordController extends Controller
{
    function index()
    {
        /*
        $users = [
            [
                'name' => 'Alex',
                'age' => 30,
            ],
            [
                'name' => 'Dan',
                'age' => 25,
            ],
            [
                'name' => 'John',
                'age' => 17,
            ],
            [
                'name' => 'Nima',
                'age' => 24,
            ]
        ];

        // to send data, after view we should give a key with any name inside a list and put the data inside that key, then it is possible to use the data in the view!
        return view('dashboard', ['users' => $users]); 
        

        // to use model in controller:
        $idea = new Idea();
        // putting some values inside the variable, I didn't add id, created_at and updated_at because it is default, and I didn't add likes because it has a default value to 0
        $idea->content = "test";
        $idea->likes = 5;
        // another way to put values in the variable:
        todo: to do it in this way we should have fillable in the model
        ? for the second types of writings I will use this collor!
        ? $idea = new Idea([
        ?    "content" => 'Test',
        ?    "likes" => 10
        ? ]);
        // save it in database:
        $idea->save();
        

        // to view the models from controller there are 4 ways:
        1- var_dump(Idea::all());
        ? 2- dump(Idea::all());
        ! 3- dd(Idea::all());       this one will stop the other codes and just the dd will work
        * 4- ddd(Idea::all());      this one is dump die debug


        // this is for getting all the models:
        return view('dashboard', ['ideas' => Idea::all()]);

        //we can give ordered by here:
        return view('dashboard', [
            'ideas' => Idea::orderBy('created_at', 'DESC')->get()
        ]);
        */

        /*
            ! if you want to see the preview of your email that is sent when you creat a user:
            todo: return new WelcomeEmail(auth()->user());
        */

        // ! with is for eager load: we pass a single query to get all the users and the comments
        // ! to use comments.user, we should have relationship of users in comments model
        // ? we can do the same thing in the model as well...
        // ! if we dont want to use the relationships here we can use without() method...
        // todo: $ideas = Idea::with('user', 'comments.user')->orderBy('created_at', 'DESC');
        // todo: $ideas = Idea::without('user')->orderBy('created_at', 'DESC');

        // ! the withCount() is to count the data and will works with the relationships of the models:
        // ! we can use withCount() here but it is better to use it in model:
        // todo: $ideas = Idea::withCount('likes')->orderBy('created_at', 'DESC');
        $ideas = Idea::orderBy('created_at', 'DESC');
        // ! if we want to load multiple relationships:
        // todo: $ideas = Idea::withCount(['likes', 'comments'])->orderBy('created_at', 'DESC');

        // * searching codes:
        // * at first we should check if there is anything to search for and then we should check the search value with the database:
        if (request()->has('search')) {
            // ! where('content you want to search for', 'operation--by default is [=]--', 'matching to');
            // ! percents are for SQL syntax:
            $ideas = $ideas->where('content', 'like', '%' . request()->get('search') . '%');
        }

        // ! inside withCount we should write the relationship that we gave in user model:
        // ! countWith will count all the ideas and automatically add it to: ideas_count
        // ! it is better to send this variable globally to be able to use it in all our blade files(in app service provider):
        // todo: $topUsers = User::withCount('ideas')->orderBy('ideas_count', 'DESC')->limit(5)->get();
        // ? same code above
        // todo: $topUsers = User::withCount('ideas')->orderBy('ideas_count', 'DESC')->take(5)->get();

        // by paginate we do the pagination, in () we have the number of each in one page:
        return view('dashboard', [
            'ideas' => $ideas->paginate(3),
            // todo(if we do not do it globally): 'topUsers' => $topUsers
        ]);
    }
}
