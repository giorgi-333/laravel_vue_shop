<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_transitions extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','name','descr','lang_code'];

    protected $hidden = [
        'product_id'
    ];

    public $timestamps = false;
}
