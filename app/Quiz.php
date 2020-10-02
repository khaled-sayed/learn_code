<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillabel = ['name', 'course_id'];
    protected $guarded = ['id']; 

    public function question(){
        return $this->hasMany('App\Question');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
