<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CommonQuestion extends Model
{
    use HasFactory,SoftDeletes;
    public function ScopeActive($query)
    {
        return $query->where('status' , 1);
    }
}
