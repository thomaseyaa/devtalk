<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

            $post = Post::create([
                'body' => $request->body,
                'img_id'=>$result['public_id'],
                'img_url'=> $result['secure_url'],
                'user_id'=> session('user')->id,
            ]);

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
        
        return redirect('/home');
    }

    // Get all posts
    public function getAllPosts(){
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $users = User::get();
        foreach($posts as $post){
            $post->publication_date = Carbon::parse($post->created_at)->locale('fr')->diffForHumans();
            $comments = Comment::where('post_id',$post->id)->orderBy('id', 'desc')->get();
            
            if($comments){
                $post->comments = $comments;
                foreach($comments as $comment){
                    foreach($users as $user){
                        if($comment->user_id ==  $user->id){
                            $comment->user_name = $user->first_name;
                            $comment->user_image = $user->img_url;
                            $comment->publication_date = Carbon::parse($comment->created_at)->locale('fr')->diffForHumans();
                        }
                    }
                }
            }
            else{
                $post->comments = [];
            }
        }

        $user = session('user');
        
        return view('home', ['posts' => $posts, 'user' => $user, 'users' => $users]);
    }

    // Get one post
    public function getPost($id){
        $post =  Post::where('id', $id)->get();

        return view('post', ['post' => $post]);
    }

    // Delete a post
    public function deletePost($id){
        $post = Post::where('id',$id)->first();
        
        if(!$post){
            return redirect('/');
        }
        else if($post->user_id == session('user')->id){
            if($post->img_id){
                $api = new \Cloudinary\Uploader();
                $result = $api->destroy($post->img_id);
            }

            $likesDelete = Like::where('likeable_id',$id)->delete();
            $postDelete = Post::where('id',$id)->delete();
            
            return redirect('/home');
        }
        else{
            return redirect('/');
        }
    }

    // Like a post
    public function likePost(Request $request, $id)
    {
        $post =  Post::where('id', $id)->first();

        if ($post->hasLiked()) {
            $postLikeDelete = Like::where('user_id', session('user')->id)->where('likeable_id', $id)->delete();
            return redirect('/home');
        }

        $post->likes()->create([
            'user_id' => session('user')->id
        ]);

        return redirect()->back();
    }

    // Comment a post
    public function commentPost(Request $request, $id){
        $request->validate([
            'comment_body' => 'required',
        ]);

        $comment = Comment::create([
            'body' => $request->comment_body,
            'post_id' => $id,
            'user_id'=> session('user')->id,
        ]);

        return redirect('/home');
    }

    // Like a comment
    public function likeComment(Request $request, $id)
    {
        $comment =  Comment::where('id', $id)->first();

        if ($comment->hasLiked()) {
            $commentLikeDelete = Like::where('user_id', session('user')->id)->where('likeable_id', $id)->delete();
            return redirect('/home');
        }

        $comment->likes()->create([
            'user_id' => session('user')->id
        ]);

        return redirect()->back();
    }
}
