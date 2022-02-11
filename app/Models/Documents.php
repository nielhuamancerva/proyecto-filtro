<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;


    protected $casts = [
            'created_at' => 'date:America/Peru@Y-m-d H:i:s' ,
            'updated_at' => 'datetime:Y-m-d H:i:s' 
    ];
}
