<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ["key","value","creator_id"];
    
    public function privilege(){
        return $this->hasMany("App\Models\Privilege");
    }

    public function user(){
        return $this->hasOne("App\Models\User");
    }
}
