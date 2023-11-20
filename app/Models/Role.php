<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ["key","value","creator_id","created_at"];
    
    public function privileges(){
        return $this->belongsToMany(Privilege::class,"role_privileges");
    }

    public function user(){
        return $this->hasOne("App\Models\User","id","creator_id");
    }
}
