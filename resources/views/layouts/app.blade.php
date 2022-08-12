<!DOCTYPE html>
<html lang={{ __('messages.lang') }}>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"/>
</head>
<body>
<div class="container">
    <ul class="nav d-flex ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('locale', ['locale' => 'en']) }}">EN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('locale', ['locale' => 'uk']) }}">UK</a>
        </li>
    </ul>

    @yield('content')
</div>
</body>
</html>
