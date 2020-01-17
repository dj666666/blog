<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //允许填充的字段
    protected $fillable = ['content'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
