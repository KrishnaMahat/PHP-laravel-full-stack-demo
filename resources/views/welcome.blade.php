@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>Beware!! This is seriously addictive</p>
                <br>
                <a href="/meme" class="btn btn-outline-primary">Show Meme</a>
            </div>
        </div>
    </div>
@endsection