@extends('layouts.app')

@section('title',  __('messages.posts.index.title'))

@section('content')
    <a class="btn btn-success my-4" href="{{ route('posts.create') }}">{{ __('messages.posts.create.btn') }}</a>

    <div class="row">
        @foreach($posts as $post)
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-text w-50">{{ $post->title }}</p>

                            <div class="btn-group">
                                <a class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}">{{ __('messages.posts.edit.btn') }}</a>
                                <a class="btn btn-info" href="{{ route('posts.show', $post->id) }}">{{ __('messages.posts.show.btn') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $posts->links() }}

@endsection
