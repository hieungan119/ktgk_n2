<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm cây cảnh</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .main-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 30px; }
        .header-title { text-align:center; font-weight:bold; font-size: 26px; color: #1a73e8; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px; }
        .btn-add-green { background-color: #28a745; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; display: inline-block; transition: 0.3s; border: none; }
        .btn-add-green:hover { background-color: #218838; color: white; text-decoration: none; }
        .table thead { background-color: #343a40; color: white; }
        .img-product { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11 main-container">
                <div class="header-title">
                    Hệ Thống Quản Lý Sản Phẩm Cây Cảnh
                </div>

                <div class="mb-4">
                    <a href="{{ url('/caycanh/create') }}" class="btn-add-green">
                        <i class="fas fa-plus"></i> Thêm 
                    </a>
                </div>

                <table id="caycanh-table" class="table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Tên khoa học</th>
                            <th>Tên thông thường</th>
                            <th>Độ khó</th>
                            <th>Ánh sáng</th>
                            <th>Nhu cầu nước</th>
                            <th>Giá bán</th>
                            <th>Ảnh</th>
                            <th style="width: 130px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ds_sanpham as $sp)
                        <tr>
                            <td class="font-weight-bold">{{ $sp->ten_san_pham }}</td>
                            <td><i>{{ $sp->ten_khoa_hoc }}</i></td>
                            <td>{{ $sp->ten_thong_thuong }}</td>
                            <td>
                                <span class="badge badge-info">{{ $sp->do_kho }}</span>
                            </td>
                            <td>{{ $sp->yeu_cau_anh_sang }}</td>
                            <td>{{ $sp->nhu_cau_nuoc }}</td>
                            <td><b class="text-success">{{ number_format($sp->gia_ban, 0, ',', '.') }}đ</b></td>
                            <td class="text-center">
                                <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}" class="img-product" alt="anh-cay">
                            </td>
                            <td>
                                <div class="btn-group">
  
                                    <a href="{{ url('/caycanh/detail/'.$sp->id) }}" class='btn btn-sm btn-primary'>Xem</a>
                                    &nbsp;
                                    <form method='post' action="{{ route('caycanh.delete', ['id' => $sp->id]) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                        @csrf
                                        <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>

    <script>
    $(document).ready(function() {
        $('#caycanh-table').DataTable({
            responsive: true,
            pageLength: 10, 
            lengthMenu: [10, 25, 50, 100], 
            bStateSave: true,
            
        });
    });
    </script>
</body>
</html>