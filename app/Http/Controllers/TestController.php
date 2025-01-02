<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function testList()
    {
        return Test::get();
        // return view('view',compact('list'));
    }

    public function Create(Request $request)
    {
        try {
            return Test::create([
                "name" => $request->input("name"),
                "email" => $request->input("email")
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], 500);
        }
    }
    public function Edit(Request $request)
    {
        $user_id=$request->input('id');
        return Test::where('id',$user_id)->first();
    }

    public function update(Request  $request)
    {
        $user_id=$request->input('id');
        return Test::where('id',$user_id)->update([
            "name" => $request->input("name"),
            "email" => $request->input("email")
        ]);
    }
    public function Delete(Request $request){
        $user_id=$request->input('id');
        return Test::where('id',$user_id)->delete();
    }
}
