<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
        'author'
    ];
    protected $table = 'blog_posts';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'author');
    }
}
