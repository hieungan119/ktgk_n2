<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request, $id_danh_muc = null)
    {
        $query = DB::table('san_pham');

        $category_id = $id_danh_muc ?? $request->id_danh_muc;
        
        if ($category_id) {
            $query->join('sanpham_danhmuc', 'san_pham.id', '=', 'sanpham_danhmuc.id_san_pham')
                  ->where('sanpham_danhmuc.id_danh_muc', $category_id)
                  ->select('san_pham.*');
        }

        if ($request->filter == 'de_cham_soc') {
            $query->where('do_kho', 'LIKE', '%Dễ%');
        }

        if ($request->filter == 'bong_ram') {
            $query->where('yeu_cau_anh_sang', 'LIKE', '%Bóng râm%');
        }

        if ($request->sort == 'gia_tang') {
            $query->orderBy('gia_ban', 'asc');
        } elseif ($request->sort == 'gia_giam') {
            $query->orderBy('gia_ban', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $data = $query->limit(20)->get();

        return view('caycanh.index', compact('data', 'category_id'));
    }

    public function detail($id)
    {
        $item = DB::table('san_pham')->where('id', $id)->first();
        if (!$item) return abort(404);
        return view('caycanh.detail', compact('item'));
    }
}