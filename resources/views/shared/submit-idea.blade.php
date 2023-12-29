<h4> Share yours ideas </h4>
<div class="row">
    {{-- 
        ! another way of down code is to use the name in the route (using the name of the rout that we gave in web.php):
        * <form action="{{ route(idea.store) }}" method="post">
        --}}
    <form action="{{ url('/ideas') }}" method="post">
        @csrf {{-- ! this is for not getting the 419 error (page expired), it is a kind of security against csrf attacks --}}
        <div class="mb-3">
            <textarea name="idea" class="form-control" id="idea" rows="3"></textarea>
            {{-- ! to show error(the message is directly from laravel): --}}
            @error('idea')
                <span class="d-block fs-6 text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="">
            {{-- ! type="submit" in html 5 is not necessary --}}
            <button type="submit" class="btn btn-dark"> Share </button>
        </div>
    </form>
</div>
