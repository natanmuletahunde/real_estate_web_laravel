<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;

class PropImage extends Model
{
    protected $table = 'prop_image';
    protected $fillable = [
        'Prop_id',
        'image',
       
    ];
    public $timestamp = true;
}
