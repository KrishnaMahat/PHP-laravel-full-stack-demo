@extends('layouts.app')
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row d-flex gap-1 justify-content-center text-center mb-3">
                    <div class="col-8">
                        <h1 class="display-one">Memer Community</h1>
                        @auth
                        <p>Enjoy reacting and sharing Memes.</p>
                        @endauth
                        @guest
                            <p>Please register or login to react and share Memes.</p>
                        @endguest
                    </div>

                    @if(\Auth::user())
                    <div class="col-4">
                        <p>Lets contribute</p>
                        <a href="/meme/create/post" class="btn btn-warning btn-sm">Add Memes</a>
                    </div>
                    @endif
                    
                </div>                
                @forelse($posts as $post)
                @php
                $user_id = $post->user_id;
                $user  = \App\Models\User::find($user_id);
                @endphp
                <div class="row d-flex gap-1 justify-content-center mb-3">
                 <div class="card p-4 custom-card">
                 <div class="card-title"><h4>Memer: <a href="./meme/profile/{{$user_id}}" style="text-decoration:none"> {{$username = $user->name;}}</a></h4></div>
                 Created at: {{ ($post->created_at) }}
                 
                    
                    <ul style = "list-style-type: none;">
                    <div class="card-title mt-2"><h5>{{ ucfirst($post->title) }}<h5></div>
                    <img src = "{{asset('images/'.$post->photo_path)}}" class ="card-img-top w-720 custom-image" >
                        <li  >
                       
                        <a href="/meme/{{$post->id}}" class="btn btn-primary mt-3"  @if( $post->user_id != auth()->id()) hidden @endif>  Settings </a>
                        
                        </li>
                    </ul>
                    <div class="d-flex gap-2 align-items-center">
                    <img src = "reacticon/haha.png" class = "toggle-image" height =30px width=30px id="haha-image-{{$post->id}}" @if (Auth::check()) onClick="updateHahaCount({{$post->id}}) @endif ">
                    <p id="haha-count-{{$post->id}}">{{$post->haha_count}}</p>
                    </div>
                </div>
                    <br>
                @empty
                    <p class="text-warning">No blog Posts available</p>
                @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
    
        function updateHahaCount(id) {
         
            if(document.getElementById('haha-image-'+ id).src == 'reacticon/haha.png') {
                document.getElementById('haha-image-'+ id).src = 'reacticon/hahadone.png';
            } else if(document.getElementById('haha-image-'+ id).src == 'reacticon/hahadone.png') {
                document.getElementById('haha-image-'+ id).src = 'reacticon/haha.png';
            }
            $.ajax({
                type: 'POST',
                url: "/update-haha-count/" + id,
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    var data = response.data;
                    $('#haha-count-' + id).html(data);
                },
               
                error: function() {
                    alert('Haha done Already');
                }
            });
        }
       

    </script>

    
@endsection