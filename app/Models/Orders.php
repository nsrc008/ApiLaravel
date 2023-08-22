<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function details()
    {
        return $this->hasMany(ProductDetail::class, 'order_id');
    }

    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'order_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}