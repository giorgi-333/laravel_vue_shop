<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\product_transitions as Transitons;

//
use App\Models\orders;
use App\Models\orders_info;

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
            })->orderByDesc('product.created_at')
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

    public function adminProduct($slug)
    {
        $product = DB::table('product')->where("slug", "=", $slug)->first();
        $product = json_decode(json_encode($product), true);
        $transition = DB::table('product_transitions')->where("product_id", "=", $product['id'])->get();
        $transition = json_decode(json_encode($transition), true);

        $ka_index = $transition[0]['lang_code'] === 'ka' ? 0 : 1;
        $en_index = !$ka_index ? 1 : 0;

        $info = [
            'ka' => [
                "name" => $transition[$ka_index]['name'],
                "descr" => $transition[$ka_index]['descr']
            ],
            'en' => [
                "name" => $transition[$en_index]['name'],
                "descr" => $transition[$en_index]['descr']
            ],
            'price' => $product['price'],
            'count' => $product['count'],
            'img' => $product['img'],
            'image' => $product['img']
        ];

        return response()->json($info);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $name = $params['en']["name"];

        $product = new Product;

        $imageName = $request->file('img')->getClientOriginalName();
        $imageName = str_replace(' ', '-', $imageName);

        $request->file('img')->move(public_path('images'), $imageName);

        $product->price = $params['price'];
        $product->img = '/images/' . $imageName;
        $product->count = $params['count'];
        $product->slug = Str::slug($name);

        $product->save();

        //  ka

        Transitons::create([
            'product_id' => $product->id,
            'name' => $params['ka']["name"],
            'descr' => $params['ka']["descr"],
            'lang_code' => "ka"
        ]);

        // en

        Transitons::create([
            'product_id' => $product->id,
            'name' => $params['en']["name"],
            'descr' => $params['en']["descr"],
            'lang_code' => "en"
        ]);

        //  After save

        return response()->json([
            'info' => 'success'
        ]);
    }

    public function buy(Request $request)
    {
        $params = $request->all();

        $list = $params['list'];
        $info = $params['info'];

        $ids = '';

        $added_order = orders::create([
            'user_id' => $request->user()->id,
            'address' => $info['address'],
            'number' => $info['number'],
            'confirmed' => false
        ]);

        foreach ($list as $item) {
            $ids .= strval($item['id']) . "-";

            orders_info::create([
                'product_id' => $item['id'],
                'order_id' => $added_order->id,
                'price' => $item['cart_price'],
                'count' => $item['cart_count']
            ]);

        }

        $orders_info = orders_info::all();

        $orders = orders::all();


        return response()->json([
            'ids' => $ids,
            '$orders_info' => $orders_info,
            '$orders' => $orders,
            '$added_order' => $added_order
        ]);
    }

    protected function buy_list(Request $request)
    {

        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->get();

        return response()->json($orders);
    }

    protected function buy_info(Request $request)
    {

        $params = $request->all();

        $info = DB::table('orders_info')
            ->join('product', 'orders_info.product_id', '=', 'product.id')
            ->select('orders_info.*', 'product.slug')
            ->where('orders_info.order_id',$params['id'])
            ->get();

        return response()->json($info);
    }

    public function delete($slug)
    {
        $product = DB::table('product')->where("slug", "=", $slug)->first();
        $product = json_decode(json_encode($product), true);

        DB::table('product')->where("slug", "=", $slug)->delete();
        DB::table('product_transitions')->where("product_id", "=", $product['id'])->delete();

        return response()->json([
            'info' => 'deleted'
        ]);
    }
}
