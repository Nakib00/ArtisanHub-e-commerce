<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'saller_id',
        'logo',
        'about',
        'location',
        'email'
    ];

    public function seller()
    {
        return $this->belongsTo(saller::class, 'seller_id');
    }
}
