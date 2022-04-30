<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class products extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
//        $products["url"] = url();
        $products = json_decode(json_encode($products), true);

        for($i = 0; $i < count($products); $i++) {
            $products[$i]["img"] = url("/") . $products[$i]["img"];
            $products[$i]["price"] = number_format($products[$i]["price"],2,'.','');
        }
        return response()->json($products);
    }
    public function show($slug)
    {
        $products = DB::table('products')->where("slug","=",$slug)->first();
        return response()->json($products);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $name = $data["name"];

        $imageName = $request->file('img')->getClientOriginalName();
        $imageName = str_replace(' ','-',$imageName);

        $readyData = [
            "name" => $name,
            "slug" => Str::slug($name),
            "descr" => $data["descr"],
            "price" => $data["price"],
            "count" => $data["count"],
            "img" => '/images/' . $imageName
        ];

        $request->file('img')->move(public_path('images'), $imageName);

        DB::table('products')->insert($readyData);

        return response()->json($readyData);
    }
}
