<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
    use HasFactory;

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function developer()
    {
        return $this->hasMany(Developer::class);
    }
}
