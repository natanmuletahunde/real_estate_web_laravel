<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
  

    
    protected $table = 'request';
    protected $fillable = [
        'Prop_id',
        'user_id',
       
    ];
    public $timestamp = true;
}
