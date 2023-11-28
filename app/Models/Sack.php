<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sack extends Model
{
    use HasFactory;
    protected $fillable = ["code","description","branch_id","type_id","status","created_at","deleted_at"];
}
