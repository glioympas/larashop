<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UsersLoginRequest;
class UsersController extends Controller
{
    public function signUp()
    {
    	return view('users.signup');
    }

    public function postSignup(UserCreateRequest $request)
    {
    	$input = $request->all();
    	$input['password'] = bcrypt($request->password);

    	$user = User::create($input);
    	Auth::login($user);
    	return redirect()->route('products.index');
    }

    public function signIn()
    {
    	return view('users.signin');
    }

    public function postSignin(UsersLoginRequest $request)
    {
    	if(Auth::attempt(['email'=>$request->email , 'password'=> $request->password]))
    	{
    		return redirect()->route('users.profile');
    	}
    	Session::flash('wrong_credentials','Wrong credentials.');
    	return redirect()->back();
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('products.index');
    }

    public function profile()
    {
       
                $orders = Auth::user()->orders;
                $orders->transform(function($order, $key){
                //unserialize every order's cart column :D

                $order->cart = unserialize($order->cart);
                return $order;
            });

            return view('users.profile', compact('orders'));
        
;
        
    }

}

