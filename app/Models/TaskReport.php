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
        'task_id',
        'developer_id',
        'module_id',
        'task_status',
        'is_overtime',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
