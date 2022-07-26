@extends('layouts.app')

@section('title', 'Реєстрація')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-4 mx-auto mt-4">
            <h3 class="text-center">Реєстрація</h3>
            <form method="POST" action="{{ route('post.signup') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Ім'я</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name"/>
                </div>
                <div class="mb-4">
                    <label for="surname" class="form-label">Прізвище</label>
                    <input type="text" class="form-control" name="surname" value="{{ old('surname') }}" id="surname"/>
                </div>
                <div class="mb-4">
                    <label for="login" class="form-label">Логін</label>
                    <input type="text" class="form-control" name="login" value="{{ old('login') }}" id="login"/>
                </div>
                <div class="mb-4">
                    <label for="login" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                </div>

                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-secondary" href="/signin">Увійти в профіль</a>
                    <button type="submit" class="btn btn-primary">Зареєструватись</button>
                </div>

            </form>
        </div>
    </div>
@endsection
