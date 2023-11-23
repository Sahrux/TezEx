<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;
    protected $fillable = ["tracking_id","customer_id","branch_id","status","created_at","deleted_at"];

    public function branch(){
        return $this->hasOne(Branch::class,"id","branch_id");
    }

    public function customer(){
        return $this->hasOne(Customer::class,"id","customer_id");
    }
}
