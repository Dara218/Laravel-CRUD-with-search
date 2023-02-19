<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postProcess(Request $request){

        // TODO: DD the request

        // $postValue = $request->validate([
        //     "post_value" => "required|max:250",
        //     "email" => "required",
        //     "id" => "required"
        // ]);

        // Post::create($postValue);
    }
}
