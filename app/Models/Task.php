<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'task_type_id',
        'task_code',
        'task_name',
        'task_description',
        'work_load',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function taskReports()
    {
        return $this->hasMany(TaskReport::class);
    }

}
