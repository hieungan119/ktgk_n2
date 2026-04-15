<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    //

    public function list_caycanh()
{
    $ds_sanpham = DB::table('san_pham')->where("status", 1)->get();
    
    return view('caycanh.list_caycanh', compact('ds_sanpham'));
}
    public function delete_caycanh($id)
    {
        DB::table('san_pham')->where('id', $id)->update(["status" => 0]);
        return redirect()->back();
    }
}