<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey='user_id';

    protected $fillable=[
        'user_id', 'name', 'birthday', 'gender',
        'street_address', 'city', 'state', 'postal_code', 'country',
        'locale'
    ];
    protected $appends =[
        'image_url',];

    protected $hidden =['img_profile',];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getImageUrlAttribute(){
        if ($this->img_profile)
            return Storage::url($this->img_profile);
        else null;
    }
 

}
