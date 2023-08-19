<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImages extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable =[
        'image_url',
        'product_id',
    ];

 

    public $hidden =[
        'deleted_at',
        'updated_at',
        'created_at',
        ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
