<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\product_transitions as Transitons;

class products extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('Accept-Language');

        if ($lang !== "ka" && $lang !== "en") {
            return response()->json([
                "error" => "please select language"
            ], 404);
        }

        $products = DB::table('product')
            ->join('product_transitions', function ($join) use ($lang) {
                $join->on('product.id', '=', 'product_transitions.product_id')
                    ->where('product_transitions.lang_code', '=', $lang);
            })
            ->get();

        $products = json_decode(json_encode($products), true);

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]["img"] = url("/") . $products[$i]["img"];
            $products[$i]["price"] = number_format($products[$i]["price"], 2, '.', '');
        }

        return response()->json($products);
    }

    public function show(Request $request, $slug)
    {
//        $product = DB::table('products')->where("slug","=",$slug)->first();
        $lang = $request->header('Accept-Language');

        $product = DB::table('product')
            ->join('product_transitions', function ($join) use ($lang, $slug) {
                $join->on('product.id', '=', 'product_transitions.product_id')
                    ->where('product_transitions.lang_code', '=', $lang)
                    ->where('product.slug', '=', $slug);
            })
            ->first();
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $params = $request->all();
//        $name = $data["name"];

//        $imageName = $request->file('img')->getClientOriginalName();
//        $imageName = str_replace(' ','-',$imageName);

//        $readyData = [
//            "name" => $name,
//            "slug" => Str::slug($name),
//            "descr" => $data["descr"],
//            "price" => $data["price"],
//            "count" => $data["count"],
//            "img" => '/images/' . $imageName
//        ];

//        $request->file('img')->move(public_path('images'), $imageName);
//
//        DB::table('products')->insert($readyData);

//        $transitions

//        return response()->json($data);

        $product = new Product;

        $product->price = 24;
        $product->img = "/images/bali.jpg";
        $product->count = 13;
        $product->slug = "ratam";

        $product->save();

        //  ka

        Transitons::create([
            'product_id' => $product->id,
            'name' => "რატა",
            'descr' => "კაი რატა",
            'lang_code' => "ka"
        ]);

        // en

        Transitons::create([
            'product_id' => $product->id,
            'name' => "rata",
            'descr' => "kai rata",
            'lang_code' => "en"
        ]);

        //  After save

        $data = Product::all();

        return response()->json([
            'data' => $data,
            "id" => $product->id,
            "descr - ka" => $params['ka']["descr"],
            "descr - en" => $params['en']["descr"]
        ]);
    }
}
