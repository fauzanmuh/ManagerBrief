<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'developer_job_title',
        'username',
        'password',
    ];

    public function taskReports()
    {
        return $this->hasMany(TaskReport::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
