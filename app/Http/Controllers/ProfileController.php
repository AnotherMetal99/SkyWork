<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class  ProfileController extends Controller{
    public function GetProfile($username){
        $user = User::where('username', $username)->first();

        if (!$user)abort(404);
        

        return view('profile.index', compact('user'));
    }
    public function GetEdit(){
      return view('profile.edit');
    }
    public function PostEdit(Request $request){
      $this->validate($request,[
         'first_name'=>'alpha|max:50',
         'last_name'=>'alpha|max:50',
         'username'=>'alpha|max:20',
      ]);
      
      Auth::user()->update([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'username' => $request->input('username'),
        'password' => bcrypt($request -> input('password')), 
        'email' => $request->input('email'),
    ]);

    return redirect()
           ->route('profile.edit')
           ->with('info', 'Профиль успешно обновлен!');
    }
}
?>