<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class categoryController extends Controller
{
    public function saveCategory(Request $req){

        $validator = Validator::make($req->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if($validator->fails()){
            $response = ['status'=> 400, 'message' => "Please insert the correct data"];
        }else{

            $insert = Category::create([
                'name' => $req->name,
                'description' => $req->description,
                
            ]);

            $response = [
                'status'=> 200, 
                'message' => "Save succesfully"
            ];


        }

        return response()->json($response);

    }

    public function deleteCategory(Request $req){

        $id = $req->id;

        $delet = Category::find($id);

        if($delet){
            $delet->delete();
            $response = ['status'=> 200, 'message' => "Delete successfully"];

        }else{
            $response = ['status'=> 400, 'message' => "No match record"];
        }

        return response()->json($response);

    }
}
