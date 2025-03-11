<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'client_id',
        'name',
        'address',
        'birthday',
        'gender',
        'contact_number',
        'soc_med',
        'co_borrower',
        'relationship_co',
        'branch_id'
    ];

    /**
     * Relationship with Branch model
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
