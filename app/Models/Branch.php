<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
    use HasFactory;

    protected $table = 'branches'; // Ensure table name matches DB
    protected $primaryKey = 'id'; // If using 'branch_id' as primary key
    public $incrementing = true; 
    protected $keyType = 'int';
    protected $fillable = ['branch_id', 'branch_name', 'address']; 
}

