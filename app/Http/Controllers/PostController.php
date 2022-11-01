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

    // Get all posts
    public function getAllPosts(){
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $users = User::get();
        foreach($posts as $p){
            $p->publication_date = Carbon::parse($p->created_at)->locale('fr')->diffForHumans();
            $comments = Comment::where('post_id',$p->id)->orderBy('id', 'desc')->get();
            if($comments){
                $p->comments = $comments;
                foreach($comments as $c){
                    foreach($users as $u){
                        if($c->user_id ==  $u->id){
                            $c->user_name = $u->first_name;
                            $c->user_image= $u->img_url;
                            $c->publication_date = Carbon::parse($c->created_at)->locale('fr')->diffForHumans();
                        }
                    }
                }
            }
            else{
                $p->comments= [];
            }
        }
        $user = session('user');
        return view('home', ['posts' => $posts, 'user' => $user, 'users'=> $users]);
    }
}
