<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                {{-- ! {{ (route::is('dashboard')) ? '' : '' }} means if it is on dashboard page do the first and if not do the second one: --}}
                <a class="{{ Route::is('dashboard') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('dashboard') }}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="{{ Route::is('feed') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ route('feed') }}">
                    <span>Feed</span></a>
            </li>
            <li class="nav-item">
                {{-- ! we can give the url and not the name: Request::is('terms') --}}
                <a class="{{ Request::is('terms') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ url('terms') }}">
                    <span>Terms</span></a>
            </li>
        </ul>
    </div>
    <div class="card-footer text-center py-2 flags">
        <a class="{{ Route::is('lang') ? 'text-white' : '' }} btn btn-link btn-sm" href="{{ route('lang', 'en') }}">
            <img src="{{ URL::asset('images/flags/USA.png') }}" alt="">
            En
        </a>
        <a class="{{ Route::is('lang') ? 'text-white' : '' }} btn btn-link btn-sm" href="{{ route('lang', 'pt') }}">
            <img src="{{ URL::asset('images/flags/brazil.png') }}" alt="">
            Pt
        </a>
        <a class="{{ Route::is('lang') ? 'text-white' : '' }} btn btn-link btn-sm" href="{{ route('lang', 'fa') }}">
            <img src="{{ URL::asset('images/flags/iran.png') }}" alt="">
            Fa
        </a>
        <a class="{{ Route::is('lang') ? 'text-white' : '' }} btn btn-link btn-sm" href="{{ route('lang', 'de') }}">
            <img src="{{ URL::asset('images/flags/german.png') }}" alt="">
            De
        </a>
        <a class="{{ Route::is('lang') ? 'text-white' : '' }} btn btn-link btn-sm" href="{{ route('lang', 'tr') }}">
            <img src="{{ URL::asset('images/flags/turkey.png') }}" alt="">
            Tr
        </a>
    </div>
</div>
