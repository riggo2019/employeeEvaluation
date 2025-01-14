<header class="dash-toolbar">
    <a href="javascript::void()" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </a>
    <h1 class="dash-title mb-0 ms-3" style="font-size:20px;">{{ $title ?? '' }}</h1>
    <div class="tools flex-row align-items-center gap-4">
        <form action="{{ route('change.language', app()->getLocale()) }}" method="GET" class="d-flex align-items-center gap-3">
            <select onchange="window.location.href=this.value" class="form-select-sm p-1">
                <option value="{{ route('change.language', 'vi') }}" {{ app()->getLocale() === 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                <option value="{{ route('change.language', 'ko') }}" {{ app()->getLocale() === 'ko' ? 'selected' : '' }}>한국어</option>
            </select>
        </form>
        <a href="{{ route('home.index') }}">{{ __('admin.back_to_home') }}</a>
    </div>
</header>