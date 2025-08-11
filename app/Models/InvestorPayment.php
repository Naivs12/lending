<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorPayment extends Model
{
    protected $table = 'transactions_inv';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'investor_id',
        'name',
        'due_date',
        'payment_date',
        'amount',
    ];
}
