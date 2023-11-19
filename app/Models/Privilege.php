<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{ 
    use HasFactory;

    protected $fillable = ["key","value","description","creator_id"];



    public function user(){
        return $this->hasOne("App\Models\User");
    }
}
