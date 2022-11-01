<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Get profile
    public function getProfile($id){
        $user = DB::table('users')->where('id', $id)->first();
        if ($user){
            return view('profile')->with('user', $user);
        }
        else{
            return redirect('timeline');
        }
    }
}
