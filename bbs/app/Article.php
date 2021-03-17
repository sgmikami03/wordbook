<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Relations\BelongsTo;

class Article extends Model
{
    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }
}
