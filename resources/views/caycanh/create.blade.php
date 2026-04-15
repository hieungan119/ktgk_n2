<x-cay-canh-layout>
    <x-slot name="title">
        Thêm sản phẩm
    </x-slot>

    @php
        $categories = $danhMuc;
    @endphp

    <style>
        .create-wrapper {
            max-width: 420px;
            margin: 0 auto;
            padding-top: 0;
        }

        .create-title {
            text-align: center;
            color: #1d4ed8;
            font-weight: bold;
            font-size: 16px;
            margin: 0 0 6px 0;
            text-transform: uppercase;
        }

        .create-form label {
            display: block;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .create-form .form-control {
            height: 32px;
            font-size: 14px;
            border-radius: 2px;
        }

        .create-form textarea.form-control {
            height: 70px;
            resize: none;
        }

        .create-form .form-group {
            margin-bottom: 10px;
        }

        .create-form .btn-save {
            min-width: 52px;
            padding: 3px 14px;
            font-size: 14px;
        }

        .error-text {
            color: red;
            font-size: 12px;
        }

        .success-box {
            max-width: 420px;
            margin: 10px auto;
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success success-box">
            {{ session('success') }}
        </div>
    @endif

    <div class="create-wrapper">
        <div class="create-title">THÊM</div>

        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="create-form">
            @csrf

            <div class="form-group">
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" id="ten_san_pham" class="form-control" value="{{ old('ten_san_pham') }}">
                @error('ten_san_pham')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ten_khoa_hoc">Tên khoa học</label>
                <input type="text" name="ten_khoa_hoc" id="ten_khoa_hoc" class="form-control" value="{{ old('ten_khoa_hoc') }}">
            </div>

            <div class="form-group">
                <label for="ten_thong_thuong">Tên thông thường</label>
                <input type="text" name="ten_thong_thuong" id="ten_thong_thuong" class="form-control" value="{{ old('ten_thong_thuong') }}">
            </div>

            <div class="form-group">
                <label for="mo_ta">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
            </div>

            <div class="form-group">
                <label for="do_kho">Độ khó</label>
                <input type="text" name="do_kho" id="do_kho" class="form-control" value="{{ old('do_kho') }}">
            </div>

            <div class="form-group">
                <label for="yeu_cau_anh_sang">Yêu cầu ánh sáng</label>
                <input type="text" name="yeu_cau_anh_sang" id="yeu_cau_anh_sang" class="form-control" value="{{ old('yeu_cau_anh_sang') }}">
            </div>

            <div class="form-group">
                <label for="nhu_cau_nuoc">Nhu cầu nước</label>
                <input type="text" name="nhu_cau_nuoc" id="nhu_cau_nuoc" class="form-control" value="{{ old('nhu_cau_nuoc') }}">
            </div>

            <div class="form-group">
                <label for="gia_ban">Giá bán</label>
                <input type="number" step="0.01" name="gia_ban" id="gia_ban" class="form-control" value="{{ old('gia_ban') }}">
                @error('gia_ban')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hinh_anh">Ảnh</label>
                <input type="file" name="hinh_anh" id="hinh_anh" class="form-control p-1">
                @error('hinh_anh')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center mt-2">
                <button type="submit" class="btn btn-primary btn-save">Lưu</button>
            </div>
        </form>
    </div>
</x-cay-canh-layout>