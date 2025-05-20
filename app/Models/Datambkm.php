<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datambkm extends Model
{
    use HasFactory;
    protected $table = 'data_mbkm';
    protected $guarded = ['id'];
}