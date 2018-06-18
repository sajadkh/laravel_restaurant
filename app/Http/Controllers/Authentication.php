<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class Authentication extends Controller
{

    public function sign_in(Request $request){
        $user = User::where('name',$request->input('name'))->first();
        if(isset($user) && $user->password == md5($request->input('password'))){
            if($user->token != "")
                return "{\"result\":\"true\" , \"token\":\"".$user->token."\"}";
            else{
                return "{\"result\":\"true\" , \"token\":\"".$user->setToken()."\"}";
            }
        }
        else{
            return "{\"result\":\"false\" , \"token\":\"\"}";
        }
    }

    public function sign_up(Request $request){
        $user = new User();
        if($user->insert($request->input("name"),$request->input("email"),$request->input("password")))
            $user->save();
        return "{\"result\":\"true\" , \"token\":\"".$user->token."\"}";
    }

    public function log_out(Request $request){
        $user = User::where('name',$request->input('name'))->first();
        if(isset($user)){
            $user->token = "";
            $user->save();
            return "{\"result\":\"true\"}";
        }
        else
            return "{\"result\":\"false\"}";
    }

}
