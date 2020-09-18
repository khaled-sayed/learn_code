<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillabel = ['title','score', 'answers', 'right_answer'];

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }
}
