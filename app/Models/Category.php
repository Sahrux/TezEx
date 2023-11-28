<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ["key","value","type_id","deleted_at","created_at"];

    function type(){
        return $this->hasOne(Type::class,"id","type_id");
    }
}
