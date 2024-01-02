@if (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{-- ! because HTTP protocol is stateless, session provide a way to store information about the user across requests.
             ! The HTTP protocol is a stateless one. This means that every HTTP request the server receives is independent and does not relate to requests that came 
             ! prior to it. --}}
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
