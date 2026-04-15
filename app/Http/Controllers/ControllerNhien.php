<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmail;
use App\Models\User;

class ControllerNhien extends Controller
{
   public function index() 
{   
     $data = DB::table('san_pham')->limit(20)->get();
    return view("caycanh.index", compact("data"));
}
public function detail($id)

{
    $data = DB::table('san_pham')->where('id', $id)->first();
    if (!$data) {
        return "Không tìm thấy loại cây cảnh này ";
    }
    return view("caycanh.detail", compact("data"));

}
   public function cartadd(Request $request)
{
    $request->validate([
        "id" => ["required", "numeric"],
        "num" => ["required", "numeric"]
    ]);

    $id = $request->id;
    $num = $request->num;
    $cart = session()->get("cart", []);

    if(isset($cart[$id])) {
        $cart[$id] += $num;
    } else {
        $cart[$id] = $num;
    }

    session()->put("cart", $cart);

    return response()->json([
        'total_items' => count($cart)
    ]);
}
    public function order()
{
    $cart = [];
    $data = [];
    $quantity = [];
    if (session()->has('cart')) {
        $cart = session("cart");
        $ids = array_keys($cart);
        if (!empty($ids)) {
            $quantity = $cart;
            $data = DB::table("san_pham")
                      ->whereIn("id", $ids)
                      ->get();
        }
    }
    return view("caycanh.order", compact("quantity", "data"));
}
    public function cartdelete(Request $request)
    {
    $request->validate([
    "id"=>["required","numeric"]
    ]);
    $id = $request->id;
    $total = 0;
    $cart = [];
    if(session()->has('cart'))
    {
    $cart = session()->get("cart");
    unset($cart[$id]);
    }
    session()->put("cart",$cart);
    return redirect()->route('order');
    }
public function ordercreate(Request $request)
{
    $request->validate([
        "hinh_thuc_thanh_toan" => ["required", "numeric"]
    ]);

    if (session()->has('cart')) {
        $cart = session("cart");
        $ids = array_keys($cart);

        if (!empty($ids)) {
            // Khởi tạo các biến để hứng dữ liệu dùng cho Email
            $data = [];
            $quantity = $cart; 

            DB::transaction(function () use ($request, $cart, $ids, &$data) {
                // 1. Lưu đơn hàng
                $id_don_hang = DB::table("don_hang")->insertGetId([
                    "ngay_dat_hang" => now(),
                    "tinh_trang" => 1,
                    "hinh_thuc_thanh_toan" => $request->hinh_thuc_thanh_toan,
                    "user_id" => Auth::id() // ID của người đang đặt hàng
                ]);

                // 2. Lấy thông tin sản phẩm để gửi kèm email
                $data = DB::table("san_pham")->whereIn("id", $ids)->get();

                // 3. Lưu chi tiết đơn hàng
                $detail = [];
                foreach ($data as $row) {
                    $detail[] = [
                        "ma_don_hang" => $id_don_hang,
                        "id_san_pham" => $row->id, 
                        "so_luong"    => $cart[$row->id],
                        "don_gia"     => $row->gia_ban
                    ];
                }
                DB::table("chi_tiet_don_hang")->insert($detail);

                // 4. Xóa giỏ hàng
                session()->forget('cart');
            });

            // GỬI EMAIL ĐẾN NGƯỜI VỪA ĐẶT HÀNG (Auth::user())
            $user = Auth::user(); 
            if ($user) {
                Notification::send($user, new SendEmail($data, $quantity));
            }

            return view("email_template.don_hang_thanh_cong", compact('data', 'quantity'));
        }
    }
    return redirect()->route('home');
}
public function testemail()
{
    $user = User::find(2);
    if ($user) {
        // Truyền [] và [] để không bị lỗi "Too few arguments"
        Notification::send($user, new SendEmail([], [])); 
        
        return "Đã gửi email thành công đến: " . $user->email;
    }
    return "Không tìm thấy người dùng có ID là 2";
}
}
