<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'task_type_id',
        'task_id',
        'user_id',
        'module_id',
        'task_status',
        'is_overtime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'user_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
