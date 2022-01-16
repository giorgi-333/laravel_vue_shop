<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageContr extends Controller
{
    public function store(Request $request) {

        $filename = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $filename);

        return response()->json([
          'message' => "text"
        ]);
    }
}
