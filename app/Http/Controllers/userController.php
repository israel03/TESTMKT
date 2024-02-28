<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class userController extends Controller
{
    public function saveUser(Request $req){

        $validator = Validator::make($req->all(), [
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            $response = ['status'=> 400, 'message' => "Please insert the correct data"];
        }else{

            $insert = User::create([
                'name' => $req->name,
                'email' => $req->email,
                
            ]);

            $response = [
                'status'=> 200, 
                'message' => "Save succesfully"
            ];


        }

        return response()->json($response);

    }

    public function deleteUser(Request $req){

        $id = $req->id;

        $delet = User::find($id);

        if($delet){
            $delet->delete();
            $response = ['status'=> 200, 'message' => "Delete successfully"];

        }else{
            $response = ['status'=> 400, 'message' => "No match record"];
        }

        return response()->json($response);

    }
}
