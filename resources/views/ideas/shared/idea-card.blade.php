aa<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageURL() }}"
                    alt="{{ $idea->user->name }}">
                <div>
                    {{-- ! we get the name from the relatiosship that we made in the user and idea models --}}
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                            {{ $idea->user->name }}</a></h5>
                </div>
            </div>
            <div>
                <form action="{{ route('ideas.destroy', $idea->id) }}" method="post">
                    <a class="ms-2" href="{{ route('ideas.show', $idea->id) }}">View</a>
                    @auth
                        {{-- ! idea edit is for gate --}}
                        {{-- todo: @can('idea.delete', $idea) --}}
                        {{-- ! update is for policy: --}}
                        @can('update', $idea)
                            {{-- ! we need to pass an id to the rout not to get error: --}}
                            <a href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                            {{-- ! on web request we can do just get and post request but in laravel we can show that is a delete request: --}}
                            @method('delete')
                            @csrf
                            <button class="ms-1 btn btn-danger btn-small">Delete</button>
                        </form>
                    @endcan
                @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        {{-- ! ?? means that if the $editing is null or undefind set a default value to false: --}}
        @if ($editing ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{-- ! toDateString helps to just show the day and not the hour --}}
                    {{-- ! the name of all these methods are laravel carbon: --}}
                    {{-- ! {{ $idea->created_at->toDateString() }} </span> --}}
                    {{-- ! diffForHumans() will show how long ago, the post was created: --}}
                    {{ $idea->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('ideas.shared.comments-box')
    </div>
</div>
