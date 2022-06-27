<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\cart as cartM;

class cart extends Controller
{
    public function index(Request $request)
    {
        $cart = DB::table('cart')->where('user_id',$request->user()->id)->get();
        $cart = json_decode(json_encode($cart), true);

        $lang = $request->header('Accept-Language');

        $query = DB::table('product')
            ->join('product_transitions', function ($join) use ($lang) {
                $join->on('product.id', '=', 'product_transitions.product_id')
                    ->where('product_transitions.lang_code', '=', $lang);
            });

        foreach($cart as $item){
            $query->orWhere('product.id', $item['product_id']);
        }

        $product = $query->get();
        $product = json_decode(json_encode($product), true);


        for ($i = 0; $i < count($product); $i++) {
            $product[$i]["cart_count"] = $cart[$i]["count"];
            $product[$i]["cart_price"] = number_format($cart[$i]["price"], 2, '.', '');
        }

        $sum = DB::table("cart")->get()->sum("price");


        return response()->json([
            'list' => $product,
            'sum' => $sum,
            'all' => count($product)
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $exists = cartM::where('product_id', $params['product_id'])
            ->where('user_id', $request->user()->id)->get();

        if (!count($exists)) {
            cartM::create([
                'product_id' => $params['product_id'],
                'user_id' => $request->user()->id,
                'count' => $params['count'],
                'price' => $params['price']
            ]);
            return response()->json([
                'product_id' => $params['product_id'],
                'user_id' => $request->user()->id
            ]);
        }

        return response()->json([
            'exists' => 'already exists'
        ]);

    }
}
