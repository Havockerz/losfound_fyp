<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
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
        'verification_answer',
        'description',
        'proof_image',
        'status',
    ];

    // Optional: Define relationship to the Item 
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Optional: Define relationship to the User 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}