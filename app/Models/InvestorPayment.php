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
        'investor_id',
        'payment_date',
        'amount',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id', 'investor_id');
    }
}
