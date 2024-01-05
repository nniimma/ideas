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
                {{-- ! we can give the url and not the name: Request::is('terms') --}}
                <a class="{{ Request::is('terms') ? 'text-white bg-primary rounded' : '' }} nav-link"
                    href="{{ url('terms') }}">
                    <span>Terms</span></a>
            </li>
        </ul>
    </div>
    <div class="{{ Route::is('profile') ? 'bg-primary rounded' : '' }} card-footer text-center py-2">
        <a class="{{ Route::is('profile') ? 'text-white' : '' }} btn btn-link btn-sm" href="{{ route('profile') }}">View
            Profile </a>
    </div>
</div>
