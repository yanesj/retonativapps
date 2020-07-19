<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use Request;
class UserController extends Controller
{
	public function updateUser(Request $request){
		$token = Request::input('token');
		$user = Auth::user();
		$user->api_token=$token;
		$user->save();
		$return = array();
		array_push($return,array('message'=>'Empresa creada exitosamente.'));
		return response()->json($return);
	}
}
