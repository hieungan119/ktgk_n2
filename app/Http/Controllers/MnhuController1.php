<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MnhuController1 extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            $products = [];
        } else {
            $products = DB::table('san_pham')
                ->where('ten_san_pham', 'LIKE', "%{$keyword}%")
                ->get();   
        }

        $categories = DB::table('danh_muc')->get();

        return view('caycanh.search', compact('products', 'categories', 'keyword'));
    }
}