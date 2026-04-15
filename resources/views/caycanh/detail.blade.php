<x-cay-canh-layout>
<x-slot name='title'>
    Cây cảnh
</x-slot>
<div class='cay-canh-info'> 
  <div>
    <img src="{{asset('storage/image/'.$data->hinh_anh)}}" width="250x" height="300px">
  </div>
  <div>
    <h4>{{$data->ten_san_pham}}</h4>
    Tên khoa học: {{$data->ten_khoa_hoc}}</><br>
    Tên thông thường: {{$data->ten_thong_thuong}}</><br>
    Mô tả: {{$data->mo_ta}}</><br>
    Quy cách sản phẩm: {{$data->quy_cach_san_pham}}</><br>
    Độ khó: {{$data->do_kho}}</><br>
    Yêu cầu ánh sáng: {{$data->yeu_cau_anh_sang}}</><br>
    Nhu cầu nước: {{$data->nhu_cau_nuoc}}</><br>
    <p>Giá: <b class="price-style">{{number_format($data->gia_ban, 0, ",", ".")}} VNĐ</b></p>    
    <div class='mt-1'> Số lượng mua:
    <input type='number' id='product-number' size='5' min="1" value="1">
    <button class='btn btn-primary btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
</div>
  </div>
</div>
</x-cay-canh-layout>
<script>
$(document).ready(function(){
    $("#add-to-cart").click(function(){
        let id = "{{$data->id}}";
        let num = $("#product-number").val();
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('cartadd')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "num": num
            },
            success: function(data){
                // Cập nhật số lượng trên icon giỏ hàng ở Layout
                $("#cart-number-product").html(data.total_items); 
                alert("Đã thêm sản phẩm vào giỏ hàng thành công!");
            },
            error: function (xhr, status, error){
                console.error(error);
                alert("Có lỗi xảy ra, vui lòng thử lại.");
            }
        });
    });
});
</script>
