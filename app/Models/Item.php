<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Add this line to force the model to use the "items" table
    protected $table = 'items';

    protected $fillable = [
        'item_name', 
        'description', 
        'location', 
        'reported_date', 
        'type',
        'item_type', 
        'image', 
        'user_id'
    ];

public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}
