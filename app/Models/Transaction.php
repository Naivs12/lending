<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'loan_id',
        'client_id',
        'branch_id',
        'term',
        'amount_pd',
        'amount_due',
        'payment_date',
        'due_date'
        
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'loan_id');
    }
}
