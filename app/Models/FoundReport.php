<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoundReport extends Model
{
    use HasFactory;

    /** 
     * The attributes that are mass assignable. 
     * 
     * @var array<int, string> 
     */
    protected $fillable = [
        'item_id',
        'user_id',
        'location_found',
        'details',
        'image',
        'status',
    ];

    /** 
     * Relationship to the Item being reported. 
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /** 
     * Relationship to the User who found the item. 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}