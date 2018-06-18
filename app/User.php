<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public function insert($name , $email , $password){
        $this->name = $name;
        $this->email = $email;
        $this->password = md5($password);
        $this->token=$this->RandomString(20);
        return true;
    }

    public function setToken(){
        $this->token = $this->RandomString(20);
        $this->save();
        return $this->token;
    }

    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function table()
    {
        return $this->hasOne('App\Table');
    }
}
