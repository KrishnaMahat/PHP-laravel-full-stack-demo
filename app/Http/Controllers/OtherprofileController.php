<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OtherprofileController extends Controller
{
    public function index($id)
    {
    
        $posts = BlogPost::where('user_id', $id)->latest()->get();
        // $posts = $posts->posts;
        // $posts = BlogPost::latest()->get....();
        // $posts = BlogPost::latest()->get();
	    return view('meme.otherprofile', [
            'posts' => $posts
        ]);
        
    }
}
