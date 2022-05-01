<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['user', 'transaction_details'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaction');
    }
}
