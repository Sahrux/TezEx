<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sack extends Model
{
    use HasFactory;
    protected $fillable = ["code","name","description","branch_id","type_id","status","created_at","deleted_at"];

    public function branch(){
        return $this->hasOne(Branch::class,"id","branch_id");
    }

    public function type(){
        return $this->hasOne(Type::class,"id","type_id");
    }
}
