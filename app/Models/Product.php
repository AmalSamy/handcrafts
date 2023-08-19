<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'slug', 'description', 'quantity','delivery_period','image', 'category_id', 'store_id',
        'price', 'compare_price', 'status',
    ];

    protected $hidden = [
        'image',
        'created_at',
         'updated_at',
         'deleted_at',
    ];
    protected $appends=['image_url'];

    // Accessors
    // $product->image_url
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }



    protected static function booted(){
        // static::addGlobalScope('store',function(Builder $builder){
        //     $user=Auth::user();
        //     if($user->store_id){
        //     $builder->where('store_id','=',$user->store_id);
        //     }
        // });

        static::creating(function(Product $product){
            $product->slug=Str::slug($product->name);
        });

     }

    public function Category(){
       return $this->belongsTo(Category::class,'category_id','id');
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

    public function ratings()
    {
        return $this->hasOne(Rating::class, 'product_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItems::class, 'product_id', 'id');
    }


}
