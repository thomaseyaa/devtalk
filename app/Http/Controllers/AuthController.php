<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register
    public function register(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        DB::table('users')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('message', [
            'status' => 'success',
            'text' => 'Compte créé'
        ]);
        return redirect('login');
    }

    // Login
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();
       if ($user){
           if (Hash::check($request->password, $user->password)){
               session(['user' => $user]);
               return redirect('home');
           }
           else{
               session()->flash('message', [
                   'status' => 'danger',
                   'text' => 'Mauvais identifiant'
               ]);
               return redirect('login');
           }
       }
       else{
           session()->flash('message', [
               'status' => 'danger',
               'text' => 'Mauvais identifiant'
           ]);
           return redirect('login');
       }
    }

    // Logout
    public function disconnect(){
        session()->forget('user');
        return redirect('login');
    }
}
