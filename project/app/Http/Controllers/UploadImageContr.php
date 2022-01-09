<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageContr extends Controller
{
    public function store(Request $request) {
//        $data = $request->all();
//
//        $image = $data["image"];
//
//        $er = gettype($image);

        $filename = $request->file('image')->getClientOriginalName();

        $request->file('image')->move(public_path('images'), $filename);

//        $request->file('image')->store('images');

//        return  $request->file("image");

        return response()->json([
          'message' => "text"
        ]);
    }
}
