<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Followers;

class UserController extends Controller
{

   
    public function store($id)
    {
        
        $u_id = auth()->id();
        $result = Followers:: where('user_id' , $id)
        ->where('follower_id', $u_id )->exists();

        // $rowcount = Followers::where('follower_id', $u_id );
        // $followerCount = $rowcount->count();


        if ($result) {
            return redirect('/meme/profile/' . $id);
        } else {
            $newFollow = Followers::create([
                'user_id' => $id,
                'follower_id' =>$u_id
            ]);
        }
    
        return redirect('/meme/profile/' . $id);
    }

    public function destroy($id)
    {
        $fid = auth()->id();
        $deletedRows = Followers::where('user_id', $id)->where('follower_id', $fid)->delete();

        return redirect('/meme/profile/' . $id);
    }
    
}
