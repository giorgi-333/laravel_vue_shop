<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;

class UploadImageContr extends Controller
{
    public function store(Request $request) {

        $filename = $request->file('image')->getClientOriginalName();
        $filename = str_replace(' ','-',$filename);

        $request->file('image')->move(public_path('images'), $filename);

        $item = new UploadImage;
        $item->src = 'images/' . $filename;
        $item->save();

        return response()->json([
          'message' => $filename
        ]);
    }
}
