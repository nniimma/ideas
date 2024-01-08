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
            <button class="mb-3 btn btn-success btn-sm">Save</button>
            @include('users.shared.user-stats')
        </div>
        </form>
    </div>
</div>
