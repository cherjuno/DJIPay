<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = [
        'employee_id', 'check_in', 'check_out'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
