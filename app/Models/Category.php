<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable=['name','description','image','status'];
    protected $hidden =['created_at','updated_at','deleted_at','slug'];



    public static function rouls($id=0){
        return [
            'name'=>['required',
            'string',
            'min:3','max:255',
            Rule::unique('categories','name')->ignore($id),
             function($attribute,$value,$fails){
                if(strtolower($value) =='laravel' ){
                    $fails('please enter anather word');
                }

             }],
            'parent_id'=>['nullable','int','exists:categories,id'],
            'description'=>['nullable'],
            'image'=>['nullable'],
            'status'=>['in:active,arhived']
        ];
    }
    public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
    }

    public function scopeFilter(Builder $builder,$filters){
        if($filters['name'] ?? false){
            $builder->where('categories.name','LIKE',"%{$filters['name']}%");
        }
        if($filters['status'] ?? false){
            $builder->where('categories.status','=',"{$filters['status']}");
        }
    }

    // =================Relations============

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function childern(){
        return $this->hasMany(Category::class,'category_id','id');
    }


}
