
@extends('layouts.app')
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
        <div class ="d-flex gap-1 justify-content-center mb-3">
            <div class="col-12 pt-2 w-50">
                <h3 class="blogtitle">{{ ucfirst($post->title) }}</h3>
                <img class="blogimage" src = "{{asset('images/'.$post->photo_path)}}">
                <p class="blogpost">{!! $post->body !!} </p> 
                <hr>
                <div class="d-flex gap-2 justify-content-center">
                <a href="/meme/{{ $post->id }}/edit" class="btn btn-primary btn-sm" @if( $post->user_id != auth()->id()) 
                    hidden 
                    @endif>Edit Post</a>
                <form id="delete-frm"  action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm"  
                    @if( $post->user_id != auth()->id()) 
                    hidden 
                    @endif>Delete Post</button>
                </form>
                <a href="/meme" class="btn btn-outline-primary btn-sm">Go back</a>
</div>
            </div>
</div>
        </div>
    </div>
@endsection