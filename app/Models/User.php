<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'store_id',
        'email',
        'phone_number',
        'password',
        'type_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'deleted_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id')->withDefault();
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteProduct::class, 'user_id');

    }
    public function favorite()
    {
        return $this->belongsToMany(FavoriteProduct::class, 'user_id');

    }
    public function ratings()
    {
        return $this->hasOne(Rating::class, 'product_id', 'id');
    }

    public function store(){
        return $this->hasOne(Store::class)->withDefault();
    }




}
