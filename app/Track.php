<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillabel = ['name'];

    protected $guarded = ['id']; 

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function courses(){
        return $this->hasMany('App\Course');
    }
}
