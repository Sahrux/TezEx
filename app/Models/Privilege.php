<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{ 
    use HasFactory;

    protected $fillable = ["key","value","description","creator_id","created_at"];



    public function user(){
        return $this->hasOne("App\Models\User","id","creator_id");
    }

    public function roles(){
        return $this->belongsToMany(Roles::class,"role_privileges");
    }
}
