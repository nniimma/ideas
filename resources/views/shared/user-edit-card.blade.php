<div class="card">
    <div class="px-3 pt-4 pb-2">
        {{-- ! enctype is for when we want to send a file --}}

        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                    alt="Mario Avatar">
                <div>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="mb-1 btn btn-danger btn-sm">Delte Photo</button>
                    </form>
                    <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="post">
                        @method('put')
                        @csrf
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                        @error('name')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div>
                @auth
                    @if (Auth::id() === $user->id)
                        <a href="{{ route('users.show', $user->id) }}">View</a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="mt-4">
            <label for="image">Profile Picture</label>
            <input class="form-control" name="image" type="file" id="image">
            @error('image')
                <span class="d-block fs-6 text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>
            <div class="mb-3">
                <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button class="mb-3 btn btn-dark btn-sm">Save</button>
            <div class="d-flex justify-content-start">
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> 0 Followers </a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->ideas()->count() }} </a>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{ $user->comments->count() }} </a>
            </div>
        </div>
        </form>
    </div>
</div>
