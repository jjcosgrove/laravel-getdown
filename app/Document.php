<?php

namespace GetDown;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    public function user(){
        return $this->belongsTo('GetDown\User');
    }
}
