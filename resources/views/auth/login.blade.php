@extends('layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" action="{{ route('login') }}" method="post">
                @csrf
                <h3 class="text-center ">Login</h3>
                @include('shared.error-message')
                <div class="form-group mt-3">
                    <label for="email" class="">Email:</label><br>
                    <input type="email" name="email" id="email" class="form-control">
                    @error('email')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="password" class="">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="remember-me" class=""></label><br>
                    <input type="submit" name="submit" class="btn btn-primary btn-md" value="submit">
                </div>
                <div class="text-right mt-2">
                    <a href="{{ route('register') }}" class="">Register here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
