<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'start_time' ,
        'end_time',
        'hours_works'
    ];

    public function employees() {
        return $this->hasMany(Employee::class);
    }

    public function attendance() {
        return $this->hasMany(Attendance::class);
    }
}
