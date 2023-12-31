<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard') }}" method="get">
            {{-- ! for the form to work we always need the name for the element that wants to send data to URL --}}
            <input placeholder="..." name="search" class="form-control w-100" type="text">
            <button type="submit" class="btn btn-dark mt-2"> Search</button>
        </form>
    </div>
</div>
