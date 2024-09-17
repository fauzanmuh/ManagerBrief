<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'developer_name',
        'developer_job_title',
        'username',
        'password',
    ];

    public function taskReports()
    {
        return $this->hasMany(TaskReport::class);
    }
}
