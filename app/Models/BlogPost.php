<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory ;

    protected $fillable = ['title', 'photo_path' , 'body','haha_count','user_id'];

   
}
