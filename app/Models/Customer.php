<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ["code","name","email","password","deleted_at","created_at"];

    public function pack(){
        return $this->hasMany(Pack::class);
    }
    
}
