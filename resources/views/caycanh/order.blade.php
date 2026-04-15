<x-cay-canh-layout>
    <x-slot name='title'>
        Giỏ hàng - Thanh toán
    </x-slot>

    <div class="mt-4">
        <div style='color:#2f5d3a; font-weight:bold; font-size:18px; text-align:center; margin-bottom:20px;'>
            <i class="fa fa-shopping-cart"></i> DANH SÁCH SẢN PHẨM TRONG GIỎ HÀNG
        </div>
        
        <table class="table table-bordered table-hover" style='margin:0 auto; width:90%'>
            <thead class="thead-light">
                <tr align="center">
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên cây cảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $tongTien = 0; @endphp
                
                @forelse($data as $key => $row)
                    @php 
                        $thanhTien = $quantity[$row->id] * $row->gia_ban;
                        $tongTien += $thanhTien;
                    @endphp
                    <tr>
                        <td align='center' style="vertical-align: middle;">{{$key + 1}}</td>
                        <td align='center'>
                            <img src="{{asset('storage/image/'.$row->hinh_anh)}}" width="50px" height="50px" style="object-fit: cover; border-radius: 5px;">
                        </td>
                        <td style="vertical-align: middle;">{{$row->ten_san_pham}}</td>
                        <td align='center' style="vertical-align: middle;">
                            <b>{{$quantity[$row->id]}}</b>
                        </td>
                        <td align='center' style="vertical-align: middle;">
                            <span class="price-style">{{number_format($row->gia_ban, 0, ',', '.')}}đ</span>
                        </td>
                        <td align='center' style="vertical-align: middle; color: #d9534f; font-weight: bold;">
                            {{number_format($thanhTien, 0, ',', '.')}}đ
                        </td>
                        <td align='center' style="vertical-align: middle;">
                            <form method='post' action="{{route('cartdelete')}}">
                                @csrf
                                <input type='hidden' value='{{$row->id}}' name='id'>
                                <button type="submit" class='btn btn-sm btn-outline-danger' onclick="return confirm('Xóa cây này khỏi giỏ hàng?')">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" align="center">Giỏ hàng đang trống</td>
                    </tr>
                @endforelse
                
                <tr style="background-color: #f9f9f9;">
                    <td colspan='5' align='right'><b>Tổng cộng tiền thanh toán:</b></td>
                    <td align='center'><b style="font-size: 16px; color: #d9534f;">{{number_format($tongTien, 0, ',', '.')}}đ</b></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 mb-5" style='width:90%; margin:0 auto; text-align:center; padding: 20px; border: 1px dashed #2f5d3a; border-radius: 10px;'>
            @auth
                @if(count($data) > 0)
                    <form method='post' action="{{route('ordercreate')}}">
                        @csrf
                        <p style="font-weight: bold;">CHỌN HÌNH THỨC THANH TOÁN</p>
                        <div class='d-inline-flex mb-2'>
                            <select name='hinh_thuc_thanh_toan' class='form-control'>
                                <option value='1'>Tiền mặt khi nhận hàng (COD)</option>
                                <option value='2'>Chuyển khoản ngân hàng</option>
                                <option value='3'>Ví điện tử VNPay</option>
                            </select>
                        </div><br>
                        <button type='submit' class='btn btn-lg btn-primary mt-2' style="padding: 10px 40px;">
                            <i class="fa fa-check-circle"></i> XÁC NHẬN ĐẶT HÀNG
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning">Vui lòng chọn sản phẩm cần mua trước khi đặt hàng.</div>
                    <a href="{{url('/home')}}" class="btn btn-primary">Tiếp tục mua sắm</a>
                @endif
            @else
                <div class="alert alert-info">
                    <strong>Thông báo:</strong> Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để thực hiện đặt hàng.
                </div>
            @endauth
        </div>
    </div>
</x-cay-canh-layout>