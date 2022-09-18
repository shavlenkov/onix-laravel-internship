@extends('layouts.app')

@section('title', __('messages.signup.title'))

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-4 mx-auto mt-4">
            <h3 class="text-center">{{ __('messages.signup.title') }}</h3>
            <form method="POST" action="{{ route('post.signup') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('messages.auth.label.first_name') }}</label>
                    <input type="text" class="form-control" value="{{ old('first_name') }}" name="first_name" id="first_name"/>
                </div>
                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('messages.auth.label.last_name') }}</label>
                    <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" id="last_name"/>
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">{{ __('messages.auth.label.email') }}</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email"/>
                </div>
                <div class="mb-4">
                    <label for="login" class="form-label">{{ __('messages.auth.label.password') }}</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-secondary" href="/signin">{{ __('messages.signin.btn') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('messages.signup.btn') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
