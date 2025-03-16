<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adjustment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employee_id', 'type', 'amount', 'reason', 'date', 'meta_data'];

    protected $casts = [
        'meta_data' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
