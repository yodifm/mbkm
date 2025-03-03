<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberkasans extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'NIK_id', 'NIK');
    }
}


