<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TodoMig;

class todo extends Controller
{
    public function index()
    {
        $todo = DB::table('list')->get();
        return response()->json($todo);
    }
    public function store(Request $request)
    {

//        $data1=array(
//            'text' => 'house@example.com'
//        );
//
//        DB::table('list')->where("#")->insert($data1);

        $item = new TodoMig;



        $data = $request->all();

        $item->text = $data["re"];
        $item->save();

//        return response()->json([
//            'message' => 'New post created'
//        ]);

        return $data;
    }
}
