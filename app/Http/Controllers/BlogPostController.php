<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::latest()->get(); //fetch all blog posts from DB
	    return view('meme.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        $imageName = time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images'), $imageName);
        $newPost = BlogPost::create([
            'title' => $request->title,
            'photo_path' => $imageName,
            'body' => $request->body,
            'user_id' => $id
        ]);

        return redirect('meme/' . $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        return view('meme.show', [
            'post' => $blogPost,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('meme.edit', [
            'post' => $blogPost,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        
      
     if($request->photo != ''){        
        $path = public_path().'/images/';

        //code for remove old photo
        if($blogPost->photo != ''  && $blogPost->photo != null){
             $file_old = $path.$blogPost->photo;
             unlink($file_old);
        }

        //upload new file
        $file = $request->photo;
        $filename = time().'.'.$file->extension();
        $file->move($path, $filename);

        //for update in table
        $blogPost->update(['photo_path' => $filename]);
   }

        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
          
       return redirect('meme/' . $blogPost->id);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect('/meme');
    }
}
