<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;

class MyprofileController extends Controller
{
    public function index($id)
    {
      
        $posts = BlogPost::where('user_id', $id)->latest()->get();
	    return view('meme.myprofile', [
            'posts' => $posts
        ]);
       
        
    }

}
