<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

class ProfilesController extends Controller
{
    public function index()
    {
    	return view('Users.profile')->with('user',Auth::user());
    }

    public function update()
    {
    	$this->validate(request(),[
    		'name' => 'required',
    		'email' => 'required|email',
    		'links' => 'url',
    		'about' => 'required'
    	]);

    	$user = Auth::user();
    	/*dd(\request()->all());
    	$user->name = request()->input('name');
    	$user->email = request()->input('email');
    	$user->profile->links = request()->input('links');s
    	$user->profile->about = request()->input('about');*/

        $user->name = \request()->name;
        $user->email = \request()->email;
        $user->profile->links = \request()->links;
        $user->profile->about = \request()->about;

        $user->save();
        $user->profile->save();

        if (request()->has('password'))
        {
            $user->password = bcrypt(request()->input('password'));
        }

        $user->save();

        Session::flash('success','Profile Updated');
    	return redirect()->route('users');
    }
}
