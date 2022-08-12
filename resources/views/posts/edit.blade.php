@extends('layouts.app')

@section('title', __('messages.posts.index.title'))

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto mt-4">
            <h3 class="text-center">{{  __('messages.posts.edit.title') }}</h3>
            <form class="form-group" method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input name="title" value="{{ $post->title }}" type="text" class="form-control" placeholder="{{ __('messages.posts.placeholder.title') }}"><br>
                <textarea class="form-control" placeholder="{{ __('messages.posts.placeholder.text') }}" style="resize: none" name="text" id="" cols="50" rows="10">{{ $post->text }}</textarea><br>
                <input name="keywords" value="{{ $post->keywords }}" type="text" class="form-control" placeholder="{{ __('messages.posts.placeholder.keywords') }}"><br>
                <input name="cover" type="file" class="form-control"><br>

                <button type="submit" class="btn btn-primary">{{ __('messages.posts.edit.btn') }}</button>
            </form>
        </div>
    </div>
@endsection
