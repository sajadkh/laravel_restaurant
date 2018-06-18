<?php

namespace App\Http\Controllers;

use App\Table;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Restaurant extends Controller
{

    //this is for create table
    //this method just callable for admin user
    public function create_tables(Request $request){
        if($request->input('name')=="admin" && $request->input('token')== User::where('name',$request->input('name'))->first()->token) {
            $two = (int)$request->input('two');
            for ($i = 0; $i < $two; $i++) {
                $table = new Table();
                $table->setCapacity(2);
            }
            $four = (int)$request->input('four');
            for ($i = 0; $i < $four; $i++) {
                $table = new Table();
                $table->setCapacity(4);
            }
            $six = (int)$request->input('six');
            for ($i = 0; $i < $six; $i++) {
                $table = new Table();
                $table->setCapacity(6);
            }
            return "{\"result\":\"true\"}";
        }
        return "{\"result\":\"false\"}";
    }


    //this method return tables not reserved
    public function not_reserved(){
        $tablesNotReserved = Table::where('reserved' , false)->get();
        return $tablesNotReserved;
    }

    //this method reserve a specific table
    public function reserve_table(Request $request){
        $id = (int) $request->input('table_id');
        $user = User::where('token',$request->input('token'))->first();
        $table = Table::where('id' , $id)->first();
        if(!$table->reserved){
            $table->user()->save($user);
            $user->table()->save($table);
            $table->reserve();
            return "{\"result\":\"true\"}";
        }
        return "{\"result\":\"true\"}";
    }

    public function de_reserve_table(Request $request){
        $user = User::where('token',$request->input('token'))->first();
        $id = (int) $request->input('table_id');
        $table = Table::where('id' , $id)->first();
        $table_user = $table->user()->first();
        if($table->reserved && $table_user->id == $user->id){
            $table_user -> table_id = null;
            $table_user -> save();
            $table -> user_id = null;
            $table->deReserve();
            return "{\"result\":\"true\"}";
        }
        return "{\"result\":\"true\"}";
    }


}
