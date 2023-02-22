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

    public function editPost(Request $request){

        $post = Post::find($request->id);

        $post = [
            "post_value" => $request->post_value,
            "email" => $request->email,
            "id" => $request->id
        ];

        $updatePost = $request->validate([
            "post_value" => "required|max:250",
            "email" => "required",
            "id" => "required"
        ]);

        $updatePost = Post::find($request->id);
        $updatePost->update($post);

        return redirect('timeline?id='. Auth::user()->id)->with('post-updated', 'Post updated successfully.');
    }

    public function search(Request $request){
        $searchValue = $request->input('search-value');
        $email = $request->input('email');

        $activeUser= Post::where('post_value', 'like', "%$searchValue%")
        ->where('email', '=', $email)
        ->get();

        return view('timeline', compact('activeUser'));
    }
}
