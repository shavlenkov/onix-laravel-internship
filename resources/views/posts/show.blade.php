@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        @if($post->cover != "")
            <img src="{{ Storage::url($post->cover) }}"/>
        @endif

        <h3>{{ $post->title }}</h3>
        <p>{{ $post->text }}</p>
        <p>{{ $post->keywords }}</p>
    </div>
@endsection
