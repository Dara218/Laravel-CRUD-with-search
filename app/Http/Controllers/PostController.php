<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postProcess(Request $request){

        $postValue = $request->validate([
            "post_value" => "required|max:250",
            "email" => "required",
            // "id" => "required"
        ]);

        Post::create($postValue);

        return redirect('timeline?id=' . Auth::user()->id)->with('post-created', 'Post created successfully.');
    }

    public function deleteProcess($id){
        $deletePost = Post::find($id);
        $deletePost->delete();

        return redirect('timeline?id=' . Auth::user()->id)->with('post-deleted', 'Post deleted successfully.');
    }
}
