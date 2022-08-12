@extends('layouts.app')

@section('title', __('messages.signin.title'))

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-4 mx-auto mt-4">
            <h3 class="text-center">{{ __('messages.signin.title') }}</h3>
            <form method="POST" action="{{ route('post.signin') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('messages.auth.label.email') }}</label>
                    <input type="text" class="form-control" value="{{ old('email') }}" name="email" id="email"/>
                </div>
                <div class="mb-4">
                    <label for="login" class="form-label">{{ __('messages.auth.label.password') }}</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-secondary" href="/signup">{{ __('messages.signup.btn') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('messages.signin.btn') }}</button>
                </div>

            </form>
        </div>
    </div>
@endsection
