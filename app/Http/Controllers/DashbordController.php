<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;

class DashbordController extends Controller
{
    function getDashboard()
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

        // by paginate we do the pagination, in () we have the number of each in one page:
        return view('dashboard', [
            'ideas' => Idea::orderBy('created_at', 'DESC')->paginate(3)
        ]);
    }
}
