<header class="dash-toolbar">
    <a href="javascript::void()" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
    <h1 class="dash-title mb-0 ms-3" style="font-size:20px;">{{ $title ?? '' }}</h1>
    <div class="tools">
        <a href="{{ route('home.index') }}">Về trang chủ</a>
    </div>
</header>