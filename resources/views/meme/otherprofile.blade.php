@extends('layouts.app')
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <div class="container">





        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
    
                <div class="row w-100  justify-content-center text-center">
                    <div class="text-center">
                        <div>
                            @php
                            $user_id = $posts[0]->user_id;
                            $user  = \App\Models\User::find($user_id);
                            $total = $posts->count();
                            @endphp
                            
                            <h3 class="display-one text-center mb-3">Memer@ {{$username = $user->name;}} </h3>  
                            </div>
                            <div class="d-flex gap-1 justify-content-center text-center mb-3">
                            
                            @php
                                $followers = app(\App\Models\followers::class);
                                $datas = $followers->all();
                                $count = 0;
                                $followercount =0;
                                $followingcount =0;
                            @endphp


                            @if(\Auth::user() && auth()->id()!=$user->id)       
                                    @forelse ($datas as $data)

                                    @if($data->user_id == $user->id && $data->follower_id == auth()->id()) 
                                         @php    $count +=1; @endphp
                                    @endif 
                                    @empty 
                                    
                                    @endforelse

                                    @if($count == 1)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Unfollow</button>
                                    </form>
                                    @else
                                    <form action="{{ route('users.store', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                                    </form>  
                                    @endif
                                     
                            @endif

                            @if(\Auth::user())
                            <div>
                                <a href="/meme/create/post" class="btn btn-warning btn-sm">Add Memes</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    @forelse ($datas as $data)
                    @if($data->user_id == $user->id)
                    @php    $followercount +=1; @endphp
                    @endif
                    @if($data->follower_id == $user->id)
                    @php    $followingcount +=1; @endphp
                    @endif
                    @empty
                    @endforelse


                    <div class="row w-50">
                    <div class="d-flex justify-content-between text-center">
                        <div>
                            <p class="mb-2 h5">{{$followingcount}}</p>
                            <p class="text-muted mb-0">Memer Following</p>
                        </div>
                        <div class="px-3">
                            <p class="mb-2 h5">{{$followercount}}</p>
                            <p class="text-muted mb-0">Memer Follower</p>
                        </div>
                        <div>
                            <p class="mb-2 h5">{{$total}}</p>
                            <p class="text-muted mb-0">Total Memes</p>
                        </div>
                    </div>
                    </div>
                    
                </div>                
                @forelse($posts as $post)
                <div class="row d-flex gap-1 justify-content-center mb-3">
                 <div class="card p-4 mt-4 custom-card">
                 <div class="card-title mt-2"><h4>Memer: {{$username = $user->name;}}</h4></div>
                 Created at: {{ ($post->created_at) }}
                    <ul style = "list-style-type: none;">
                    <div class="card-title mt-3"><h5>{{ ucfirst($post->title) }}</h5></div>
                    <img src = "{{asset('images/'.$post->photo_path)}}" class ="card-img-top w-100">
                        <li  >
                        
                        <a href="/meme/{{$post->id}}" class="btn btn-primary mt-2" @if( $post->user_id != auth()->id()) hidden @endif>Settings</a>
                        </li>
                      
                    </ul>
                </div>
                </div>  
                    <br>
                @empty
                    <p class="text-warning">No blog Posts available</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection