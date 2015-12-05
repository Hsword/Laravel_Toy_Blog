<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
	public function loginAction(Request $request)
	{
		//$data=[];  //empty data can't output middware error
		if(!($request->session()->has('loginError')))
			$data=[];
		else
			$data['loginError']=$request->session()->get('loginError');
		if($request->method() == 'POST')
		{
			$input = $request->input();
			$validator = Validator::make($input,[
				'username' => 'required|max:255',
			    'password' => 'required|max:255'
			]);
			if($validator->fails())
			{
				return Redirect::route('login')->withErrors($validator)->withInput($input);
			}
			//other ways to find user?
			$userObject = new User;
			$row=$userObject->where('username',$input['username'])->first();
			$data['username']= $input['username'];
			if(isset($row))
			{
				$passHash=$row->password;
				if(Hash::check($input['password'],$passHash))
				{
					$request->session()->put([
						'username' => $row->username,
						'id' => $row->id,
					]);
					return Redirect::route('home');
				}
				$data['loginError']="Invalid Password";
			}
			else
			{
				$data['loginError']="No such user!";
				unset($data['username']);
			}
		}
		return View::make('login',$data);
	}
	public function registerAction(Request $request)
	{
		$data=[];
		if($request->method() == "POST")
		{
			$input = $request->input();
			$validator = Validator::make($input,[
				"username" => "required|max:255|unique:users",
				"password" => "required|max:255|confirmed",
				"email" => "required|email|unique:users"
			]);
			if($validator->fails())
			{
				return Redirect::route('register')->withErrors($validator)->withInput($input);
			}
			$userObject = new User;
			$userObject->username=$request->username;
			$userObject->password=Hash::make($request->password);
			$userObject->email=$request->email;
			$userObject->save();
			return Redirect::route('login');
		}
		return View::make('register',$data);
	}
	public function logoutAction(Request $request)
	{
		$request->session()->flush();
		return Redirect::route('login');
	}
}
