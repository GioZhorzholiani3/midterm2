<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_unique_code',
        'paid_amount',
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
