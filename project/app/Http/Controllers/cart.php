<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\cart as cartM;

class cart extends Controller
{
    public function index()
    {
        $cart = DB::table('cart')->get();
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $params = $request->all();

        $exists = cartM::where('product_id', $params['product_id'])
            ->where('user_id', $request->user()->id)->get();

        if (!count($exists)) {
            cartM::create([
                'product_id' => $params['product_id'],
                'user_id' => $request->user()->id
            ]);
            return response()->json([
                'product_id' => $params['product_id'],
                'user_id' => $request->user()->id,
                '$exists' => $exists
            ]);
        }

        return response()->json([
            '$exists' => count($exists)
        ]);

    }
}
