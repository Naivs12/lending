<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    protected $table = 'investors';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'investor_id',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'contact_number',
        'payment_percent',
        'amount_invest',
        'branch_id'  
    ];
}
