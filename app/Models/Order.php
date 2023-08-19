<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable =[
        'user_id',
        'store_id',
        'delivery_date',
        'delivery_time',
        'payment_method',
        'payment_status',

    ];
    protected $hidden =['created_at','updated_at','deleted_at'];


    public function ratings()
    {
        return $this->hasOne(Rating::class, 'product_id', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

    // belongs
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
    public static function rouls($id=0){
        return [


        ];
    }
}
