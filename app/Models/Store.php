<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Store extends Model
{

    use HasFactory, SoftDeletes;

    public $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'

    ];

    protected $fillable = [
        'name',
        'description',
        'phone_whatsapp',
        'url_facebook',
        'url_instegram',
        'status',
        'cover_image',
        'logo_image',
        'id',

    ];







    // public function getImageLogoUrlAttribute(){
    //     if ($this->logo_image)
    //         return Storage::url($this->logo_image);
    //     else null;
    // }
    // public function getImageCoverUrlAttribute(){
    //     if ($this->logo_image)
    //         return Storage::url($this->cover_image);
    //     else null;
    // }



    public function products(){
        return $this->hasMany(Product::class,'store_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
