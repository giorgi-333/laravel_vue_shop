<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class products extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return response()->json($products);
    }
}
