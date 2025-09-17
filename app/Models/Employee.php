<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'position_id', 'nip', 'phone', 'address', 'join_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
