<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'user_id'
    ];

    protected $hidden=[
        'updated_at',
        'created_at',
    ];

    public function product() {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
