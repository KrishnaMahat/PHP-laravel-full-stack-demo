<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Likers;
use Illuminate\Http\Request;

class HahaController extends Controller
{
    public function updateHahaCount(Request $request, $id)
{
    
    $liker_id = auth()->id();
    $myModel = BlogPost::findOrFail($id);
   
  
    $liked_id = $myModel->user_id;

    $like_result = Likers:: where('blogpost_id' , $id)
    ->where('liker_id', $liker_id )
    ->where('liked_id', $liked_id )->exists();
   
   $exists = Likers:: where('blogpost_id' , $id)
    ->where('liker_id', $liker_id )
    ->where('liked_id', $liked_id );

    if($like_result){

        $haha_count = $myModel->haha_count;
        $haha_count --;
        $myModel->haha_count = $haha_count;
        $myModel->save();
        $exists->delete();
        return response()->json(['data' => $haha_count]);
    }
    else{

        $haha_count = $myModel->haha_count;
        $haha_count ++;
        $myModel->haha_count = $haha_count;
        $myModel->save();

        $newLike = new Likers;
        $newLike->blogpost_id = $id;
        $newLike->liker_id = $liker_id;
        $newLike->liked_id = $liked_id;
        $newLike->save();
        return response()->json(['data' => $haha_count]);
       
    }
   

    // $hahacount = Likers::where('blogpost_id' , $id);
    // $haha_count = $hahacount->count();
    
    


}
}
