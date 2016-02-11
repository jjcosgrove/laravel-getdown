<?php

namespace GetDown;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'templates';

    public function user(){
        return $this->belongsTo('GetDown\User');
    }
}
