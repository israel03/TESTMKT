<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\User;

class bookController extends Controller
{
    public function saveBook(Request $req){

        $validator = Validator::make($req->all(), [
            'name' => 'required|string',
            'author' => 'required|string',
            'category' => 'required|string',
            'published' => 'required|date',
           


        ]);

        if($validator->fails()){
            $response = ['status'=> 400, 'message' => "Please insert the correct data"];
        }else{

            $insert = Book::create([
                'name' => $req->name,
                'author' => $req->author,
                'category' => $req->category,
                'published_date' => $req->published,

                
            ]);

            $response = [
                'status'=> 200, 
                'message' => "Save succesfully"
            ];


        }

        return response()->json($response);

    }

    public function deleteBook(Request $req){

        $id = $req->id;

        $delet = Book::find($id);

        if($delet){
            $delet->delete();
            $response = ['status'=> 200, 'message' => "Delete successfully"];

        }else{
            $response = ['status'=> 400, 'message' => "No match record"];
        }

        return response()->json($response);

    }

    public function reserveBook(Request $req){

        $validator = Validator::make($req->all(), [
            'user' => 'required',
            'book' => 'required',

        ]);

        if($validator->fails()){
            $response = ['status'=> 400, 'message' => "Please insert the correct data"];
        }else{

           $user = User::with('books')->find($req->user);
           $book = Book::find($req->book);

           if($user && $book){

                if ($user->books->contains($book->id) || $book->user_id !== null) {
                    $response = ['status'=> 400, 'message' => "One user has already reserved this book"];
                } else {
                    $book->user()->associate($user);
                    $book->save();
                    $response = ['status'=> 200, 'message' => "Reserve successfully"];
                }

           }else{
            $response = ['status'=> 400, 'message' => "This records doesn't exists"];

           }


            


        }

        return response()->json($response);

        
    }

    public function changeStatus(Request $req){

        $book = Book::find($req->id);

        if($book){

            $book->update([
                'user_id' => NULL

            ]);

            $response = [
                'status'=> 200, 
                'message' => "Status changed"
            ];
            

        }else{
            $response = ['status'=> 400, 'message' => "This records doesn't exists"];
        }

        return response()->json($response);

    }
}
