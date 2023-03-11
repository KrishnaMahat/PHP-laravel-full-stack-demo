
@extends('layouts.app')
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/meme" class="btn btn-outline-primary btn-sm">Go back</a>
                <h1 class="blogtitle">{{ ucfirst($post->title) }}</h1>
                <img class="blogimage" src = "{{asset('images/'.$post->photo_path)}}">
                <p class="blogpost">{!! $post->body !!} </p> 
                <hr>
                <a href="/meme/{{ $post->id }}/edit" class="btn btn-outline-primary" @if( $post->user_id != auth()->id()) 
                    hidden 
                    @endif>Edit Post</a>
                <br><br>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger"  
                    @if( $post->user_id != auth()->id()) 
                    hidden 
                    @endif>Delete Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection