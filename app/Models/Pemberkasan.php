<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberkasan extends Model
{
    use HasFactory;
    protected $table = 'pemberkasan';
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'NIK_id', 'NIK');
    }
}