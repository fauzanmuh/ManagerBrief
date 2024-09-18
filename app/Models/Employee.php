<?php

namespace App\Models;

use Gate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

Gate::define('manage-employees', function (Employee $employee) {
    return $employee->isManager();
});

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'position',
        'address',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isManager()
    {
        return $this->role->name === 'manager';
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
