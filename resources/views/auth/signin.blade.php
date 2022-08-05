@extends('layouts.app')

@section('title', 'Вхід')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-4 mx-auto mt-4">
            <h3 class="text-center">Вхід</h3>
            <form method="POST" action="{{ route('post.signin') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ old('email') }}" name="email" id="email"/>
                </div>
                <div class="mb-4">
                    <label for="login" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-secondary" href="/signup">Створити профіль</a>
                    <button type="submit" class="btn btn-primary">Увійти</button>
                </div>

            </form>
        </div>
    </div>
@endsection
