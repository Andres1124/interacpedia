<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function companies(){
        return $this->belongsToMany('App\Models\Company');
    }
}
