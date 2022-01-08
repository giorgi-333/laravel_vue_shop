<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoMig extends Model
{
    use HasFactory;

    protected $table = 'list';
//    public $timestamps = false;

    protected $fillable = [
        'text'
    ];
}
