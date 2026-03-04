<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'user_id', 
    'item_name', 
    'description', 
    'type', 
    'location', 
    'reported_date', 
    'status', 
    'image'
];

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}
