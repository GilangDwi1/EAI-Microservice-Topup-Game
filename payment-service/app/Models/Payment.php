<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['id_transaction', 'jenis_pembayaran', 'total_pembayaran'];
}
