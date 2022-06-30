<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_info extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','order_id','price','count'];

    protected $table = 'orders_info';
    public $timestamps = false;
}
