<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
   // Create a post
   public function createPost(Request $request){
        $request->validate([
            'body' => 'required',
            'img' => 'mimes:jpeg,png,jpg',
        ]);
        if($request->file('image')){
            $result = \Cloudinary\Uploader::upload($request->file('image'));
            //$result = $request->file('image')->storeOnCloudinary();
            $post = Post::create([
                'body' => $request->body,
                'img_id'=>$result['public_id'],
                'img_url'=> $result['secure_url'],
                'user_id'=>session('user')->id,
            ]);
            $posts = Post::orderBy('id', 'desc')->get();
            $user = session('user');
            $users =User::get();
            return redirect('/home');
        }
        $post = Post::create([
            'body' => $request->body,
            'user_id'=>session('user')->id,
        ]);
        session()->flash('message', [
            'status' => 'success',
            'text' => 'Post publié'
        ]);
        $posts = Post::orderBy('id', 'desc')->get();
        $user = session('user');
        $users =User::get();
        return redirect('/home');
    }
}
