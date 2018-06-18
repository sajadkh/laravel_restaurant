<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function setCapacity($capacity){
        $this->capacity = $capacity;
        $this->reserved =false;
        $this->save();
        return true;
    }

    public function reserve(){
        $this->reserved = true;
        $this->save();
        return true;
    }

    public function deReserve(){
        $this->reserved = false;
        $this->save();
        return true;
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

}
