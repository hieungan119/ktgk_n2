<x-cay-canh-layout>
    <x-slot name="title">
        Kết quả tìm kiếm cho: "{{ $keyword ?? '' }}"
    </x-slot>

    <div style="padding: 20px 0;">
        <h2>Kết quả tìm kiếm cho: <strong>"{{ $keyword ?? '' }}"</strong></h2>

        @if($products->isEmpty())
            <p style="color:red; font-size:18px; text-align:center; padding:40px;">
                Không tìm thấy sản phẩm nào phù hợp với từ khóa của bạn.
            </p>
        @else
            <div class="list-cay-canh">
                @foreach($products as $product)
                    <div class="cay-canh">
                        <a href="{{ url('/san-pham/' . $product->id) }}">
                            @php
                                $imagePath = $product->hinh_anh 
                                    ? asset('storage/image/' . $product->hinh_anh) 
                                    : asset('images/no-image.jpg');
                            @endphp
                            <img src="{{ $imagePath }}" alt="{{ $product->ten_san_pham }}" 
                                 style="width:100%; height:220px; object-fit:cover; border-radius:5px;">
                            
                            <div style="padding:10px 5px;">
                                <h4 style="margin:5px 0; font-size:15px;">{{ $product->ten_san_pham }}</h4>
                                <p style="margin:0; color:#e74c3c; font-weight:bold;">
                                    {{ number_format($product->gia_ban, 0, ',', '.') }} đ
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-cay-canh-layout>