<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'game_id',
        'jumlah_topup',
        'total_harga',
        'status',
    ];

}
