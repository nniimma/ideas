@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.submit-idea')
            <hr>
            @if (count($ideas) > 0)
                @foreach ($ideas as $idea)
                    <div class="mt-3">
                        @include('shared.idea-card')
                    </div>
                @endforeach
            @else
                No results found!
            @endif
            {{-- ! 
                ! another way of doing above:
                todo: @forelse ($ideas as $idea )
                todo:      <div class="mt-3">
                todo:          @include('shared.idea-card')
                todo:      </div>
                todo: @empty
                todo:   <p class="text-center mt-4">No results found!</p>
                todo: @endforelse   
            ! --}}
            <div class="mt-3">
                {{-- this part downside is for showing the paginate arrows(pagination bottons), to go to different pages --}}
                {{-- withquerystring() will inject query strings to the URL: it is for searching times, when you search and go to next page it will help to have the search --}}
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
