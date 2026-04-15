<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class CayCanhLayout extends Component
{
    public $categories;
    public $title;

    public function __construct($title = "Green Garden")
    {
        $this->title = $title;
        // Lấy danh mục từ bảng danh_muc trong file SQL của bạn
        $this->categories = DB::table("danh_muc")->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.cay-canh-layout');
    }
}