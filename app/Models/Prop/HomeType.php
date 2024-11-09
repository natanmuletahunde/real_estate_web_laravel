<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    //
    protected $table = 'hometypes';
    protected $fillable = [
        'id',
        'hometypes',
    ];
    public $timestamp = true;
}
