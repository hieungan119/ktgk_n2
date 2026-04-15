<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddPlantsController extends Controller
{
    public function create()
    {
        $danhMuc = DB::table('danh_muc')->get();
        return view('caycanh.create', compact('danhMuc'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_san_pham'      => 'required|string|max:255',
            'ten_khoa_hoc'      => 'nullable|string|max:255',
            'ten_thong_thuong'  => 'nullable|string|max:255',
            'mo_ta'             => 'nullable|string',
            'do_kho'            => 'nullable|string|max:100',
            'yeu_cau_anh_sang'  => 'nullable|string|max:100',
            'nhu_cau_nuoc'      => 'nullable|string|max:100',
            'gia_ban'           => 'required|numeric|min:0',
            'hinh_anh'          => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'id_danh_muc'       => 'nullable|exists:danh_muc,id',
        ], [
            'ten_san_pham.required'     => 'Vui lòng nhập tên sản phẩm.',
            'gia_ban.required'          => 'Vui lòng nhập giá bán.',
            'gia_ban.numeric'           => 'Giá bán phải là số.',
            'gia_ban.min'               => 'Giá bán phải lớn hơn hoặc bằng 0.',
            'hinh_anh.required'         => 'Vui lòng chọn ảnh.',
            'hinh_anh.image'            => 'File tải lên phải là hình ảnh.',
            'hinh_anh.mimes'            => 'Ảnh phải có định dạng jpg, jpeg, png, gif hoặc webp.',
            'hinh_anh.max'              => 'Ảnh không được vượt quá 2MB.',
            'id_danh_muc.exists'        => 'Danh mục không hợp lệ.',
        ]);

        $imageFile = $request->file('hinh_anh');
        $imageName = time() . '_' . preg_replace('/\s+/', '_', $imageFile->getClientOriginalName());

        // Lưu ảnh vào storage/app/public
        $imageFile->storeAs('public/image', $imageName);

        // Tạo mã sản phẩm tự động
        $code = 'SP' . strtoupper(Str::random(6));

        $idSanPham = DB::table('san_pham')->insertGetId([
            'code'              => $code,
            'ten_san_pham'      => $request->ten_san_pham,
            'gia_ban'           => $request->gia_ban,
            'hinh_anh'          => $imageName,
            'mo_ta'             => $request->mo_ta,
            'ten_khoa_hoc'      => $request->ten_khoa_hoc,
            'ten_thong_thuong'  => $request->ten_thong_thuong,
            'quy_cach_san_pham' => $request->quy_cach_san_pham, // nếu chưa có input thì sẽ null
            'do_kho'            => $request->do_kho,
            'yeu_cau_anh_sang'  => $request->yeu_cau_anh_sang,
            'nhu_cau_nuoc'      => $request->nhu_cau_nuoc,
        ]);

        // Nếu form có chọn danh mục
        if ($request->filled('id_danh_muc')) {
            DB::table('sanpham_danhmuc')->insert([
                'id_san_pham' => $idSanPham,
                'id_danh_muc' => $request->id_danh_muc,
            ]);
        }

        return redirect()->route('create')->with('success', 'Thêm cây cảnh mới thành công.');
    }
}