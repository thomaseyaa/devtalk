<?php

namespace App\Http\Controllers;

use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    // Update profile
    public function updateProfile(Request $request){
        $request->validate([
            'first_name' => 'required',
            'email' => 'required',
            'img' => 'mimes:jpeg,png,jpg',
        ]);

        if ($request->password != null){
            if (isset($request->img)){
                if (session('user')->img_url != null){
                    $api = new \Cloudinary\Uploader();
                    $result = $api->destroy(session('user')->img_id);
                    if (!$result){
                        session()->flash('message', [
                            'status' => 'danger',
                            'text' => 'Erreur lors de la modification'
                        ]);
                        return redirect('profile');
                    }
                }
                $result = \Cloudinary\Uploader::upload($request->img);
                DB::table('users')->where('id', session('user')->id)->update([
                    'first_name' => $request->first_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'bio' => $request->bio,
                    'img_url'=> $result['secure_url'],
                    'img_id'=>$result['public_id'],
                ]);
                $user = DB::table('users')->where('id', session('user')->id)->first();
                session()->flash('message', [
                    'status' => 'success',
                    'text' => 'Profil modifié'
                ]);
                session()->forget('user');
                session(['user' => $user]);
                return redirect('profile');
            }
            else{

                DB::table('users')->where('id', session('user')->id)->update([
                    'first_name' => $request->first_name,
                    'email' => $request->email,
                    'bio' => $request->bio,
                    'password' => Hash::make($request->password)
                ]);
                session()->flash('message', [
                    'status' => 'success',
                    'text' => 'Profil modifié'
                ]);
                $user = DB::table('users')->where('id', session('user')->id)->first();
                session()->forget('user');
                session(['user' => $user]);
                return redirect('profile');
            }
        }
        elseif (isset($request->img)){
            if (session('user')->img_url != null){
                $api = new \Cloudinary\Uploader();
                $result = $api->destroy(session('user')->img_id);
                if (!$result){
                    session()->flash('message', [
                        'status' => 'danger',
                        'text' => 'Erreur lors de la modifcation'
                    ]);
                    return redirect('profile');
                }
            }
            $result = \Cloudinary\Uploader::upload($request->img);
            DB::table('users')->where('id', session('user')->id)->update([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'bio' => $request->bio,
                'img_url'=> $result['secure_url'],
                'img_id'=>$result['public_id'],
            ]);
            session()->flash('message', [
                'status' => 'success',
                'text' => 'Profil modifié'
            ]);
            $user = DB::table('users')->where('id', session('user')->id)->first();
            session()->forget('user');
            session(['user' => $user]);
            return redirect('profile');
        }
        else{
            DB::table('users')->where('id', session('user')->id)->update([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'bio' => $request->bio,
            ]);
            session()->flash('message', [
                'status' => 'success',
                'text' => 'Profil modifié'
            ]);
            $user = DB::table('users')->where('id', session('user')->id)->first();
            session()->forget('user');
            session(['user' => $user]);
            return redirect('profile');
        }
    }

    // Delete profile
    public function deleteProfile(){
        if (session('user')->img_url != null){
            $api = new \Cloudinary\Uploader();
            $result = $api->destroy(session('user')->img_id);
            if (!$result){
                session()->flash('message', [
                    'status' => 'danger',
                    'text' => 'Erreur lors de la suppresion'
                ]);
                return redirect('login');
            }
        }
        $deleteUser = DB::table('users')->where('id',session('user')->id)->delete();

        if ($deleteUser){
            session()->forget('user');
            session()->flash('message', [
                'status' => 'success',
                'text' => 'Compte supprimé'
            ]);
            return redirect('login');
        }
        else{

            session()->flash('message', [
                'status' => 'error',
                'text' => 'Erreur lors de la suppression'
            ]);
            return redirect('profile');
        }
    }
}
