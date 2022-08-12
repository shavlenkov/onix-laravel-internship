@extends('layouts.app')

@section('title', __('messages.posts.create.title'))

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto mt-4">
            <h3 class="text-center">{{  __('messages.posts.create.title') }}</h3>
            <form class="form-group" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <input name="title" value="{{ old('title') }}" type="text" class="form-control" placeholder="{{ __('messages.posts.placeholder.title') }}"><br>
                <textarea class="form-control" placeholder="{{ __('messages.posts.placeholder.text') }}" style="resize: none" name="text" id="" cols="50" rows="10">{{ old('text') }}</textarea><br>
                <input name="keywords" value="{{ old('keywords') }}" type="text" class="form-control" placeholder="{{ __('messages.posts.placeholder.keywords') }}"><br>
                <input name="cover" type="file" class="form-control"><br>

                <button type="submit" class="btn btn-primary">{{ __('messages.posts.create.btn') }}</button>
            </form>
        </div>
    </div>
@endsection
