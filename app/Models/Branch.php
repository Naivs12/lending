<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
    use HasFactory;

    protected $table = 'branches';
    protected $primaryKey = 'id';
    public $incrementing = true; 
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = ['branch_id', 'branch_name', 'address', 'contact_number']; 
}

