<?php

namespace App\Models\Prop;

use Illuminate\Database\Eloquent\Model;

class AllRequest extends Model
{
  

    
    protected $table = 'requests';
    protected $fillable = [
        'Prop_id', // Make sure this matches your database field exactly
        'agent_name',
        'user_id',
        'name',
        'email',
        'phone',
    ];
    
    public $timestamp = true;
}
