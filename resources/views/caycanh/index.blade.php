<x-cay-canh-layout>
    <div class="mb-3 d-flex justify-content-center" style="gap: 10px;">
        <p>Tìm kiếm theo</p>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'gia_tang']) }}" class="btn btn-sm btn-outline-dark">Giá tăng dần</a>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'gia_giam']) }}" class="btn btn-sm btn-outline-dark">Giá giảm dần</a>
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'de_cham_soc']) }}" class="btn btn-sm btn-outline-dark">Dễ chăm sóc</a>
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'bong_ram']) }}" class="btn btn-sm btn-outline-dark">Chịu được bóng râm</a>
    </div>

    <div class="list-cay-canh">
        @foreach($data as $item)
            <div class="cay-canh">
                <a href="{{ url('/chi-tiet/'.$item->id) }}">
                    <img src="{{ asset('storage/image/'.$item->hinh_anh) }}" 
                         onerror="this.src='{{ asset('images/'.$item->hinh_anh) }}'"
                         width="100%" height="160px" style="object-fit: cover;">
                    
                    <div class="p-2"><i>
                        <p class="mb-1" style="font-weight:bold; height: 40px; overflow: hidden;">{{ $item->ten_san_pham }}</p>
                        <p class="text-danger font-weight-bold">{{ number_format($item->gia_ban, 0, ',', '.') }} đ</p></i>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-cay-canh-layout>