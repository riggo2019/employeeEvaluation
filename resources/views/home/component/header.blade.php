<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="#" class="col-md-3 text-center">
        <img src="{{ asset('image/logo1.png') }}" alt="logo" height="50px">
    </a>
    <ul class="nav col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('home.index') }}"
                class="nav-link px-4 {{ $content == 'home.content.home' ? 'link-primary fw-bold' : 'link-secondary' }}">{{ __('messages.home') }}</a></li>
        @if (Auth::check() && Auth::user()->is_admin == 1)
            <li><a href="{{ route('admin.index') }}" class="nav-link px-4 link-secondary">{{ __('messages.admin') }}</a></li>
        @else
            @if (Auth::user()->answered == 1)
                <li><a href="{{ route('home.results') }}"
                        class="nav-link px-4 {{ $content == 'home.content.results' ? 'link-primary fw-bold' : 'link-secondary' }}">{{ __('messages.result') }}</a></li>
            @else
                <li><a href="{{ route('home.answer') }}"
                        class="nav-link px-4 {{ $content == 'home.content.answer' ? 'link-primary fw-bold' : 'link-secondary' }}">{{ __('messages.answer') }}</a></li>
            @endif
        @endif
        <li><a href="{{ route('evaluation_management', ['department_id' => 1]) }}"
                class="nav-link px-4 {{ $content == 'home.content.evaluation_management' ? 'link-primary fw-bold' : 'link-secondary' }}">{{ __('messages.evaluation_management') }}</a></li>
    </ul>


    <div class="col-md-3 d-flex flex-row">
        @if (!Auth::check())
            <div class="text-end me-4">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Đăng ký</a>
            </div>
        @else
            <div class="d-flex gap-2 flex-column align-items-end justify-content-between me-4">
                <h2 class="fs-6 mb-0">{{ __('messages.hello') }}
                    <strong>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</strong>
                </h2>
                <a href="{{ route('logout') }}" class="text-decoration-none">{{ __('messages.logout') }}</a>
            </div>
        @endif
        <form action="{{ route('change.language', app()->getLocale()) }}" method="GET"
            class="d-flex align-items-center gap-3">
            <select onchange="window.location.href=this.value" class="form-select-sm p-1">
                <option value="{{ route('change.language', 'vi') }}"
                    {{ app()->getLocale() === 'vi' ? 'selected' : '' }}>Tiếng Việt</option>
                <option value="{{ route('change.language', 'ko') }}"
                    {{ app()->getLocale() === 'ko' ? 'selected' : '' }}>한국어</option>
            </select>
        </form>
    </div>

</header>
