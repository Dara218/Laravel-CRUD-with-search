<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postProcess(Request $request){

        // dd($request->post_value);
        // TODO: Fix only redirect after post

        $postValue = $request->validate([
            "post_value" => "required|max:250",
            "email" => "required",
            // "id" => "required"
        ]);

        Post::create($postValue);

        return redirect('timeline?id=' . Auth::user()->id)->with('post-created', 'Post created successfully.');
    }
}
