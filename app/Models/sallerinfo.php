<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\saller;

class sallerinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'saller_id',
        'nid',
    ];

    public function seller()
    {
        return $this->belongsTo(saller::class, 'seller_id');
    }
}
