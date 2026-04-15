<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h3>ĐẶT HÀNG THÀNH CÔNG</h3>

    <p>Chào bạn, bạn đã đặt hàng thành công. Thông tin đơn hàng gồm:</p>

    <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <tr style="background-color: #f2f2f2;">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>

        @php $total = 0; @endphp
        @foreach($data as $item)
            @php 
                // Lấy số lượng từ mảng quantity dựa trên ID sản phẩm
                $soLuong = $quantity[$item->id] ?? 0; 
                $thanhTien = $soLuong * $item->gia_ban;
                $total += $thanhTien;
            @endphp
            <tr>
                <td>{{ $item->ten_san_pham }}</td>
                <td align="center">{{ $soLuong }}</td>
                <td align="right">{{ number_format($item->gia_ban, 0, ',', '.') }}đ</td>
                <td align="right">{{ number_format($thanhTien, 0, ',', '.') }}đ</td>
            </tr>
        @endforeach
        
        <tr>
            <td colspan="3" align="right"><b>Tổng cộng:</b></td>
            <td align="right" style="color: red; font-weight: bold;">
                {{ number_format($total, 0, ',', '.') }}đ
            </td>
        </tr>
    </table>

    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để giao hàng.</p>
    <br>
    Trân trọng!
</body>
</html>