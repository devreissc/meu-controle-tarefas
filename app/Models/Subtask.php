<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['task_id', 'subtask_name', 'subtask_description', 'due_date', 'is_complete', 'completed_at', 'status'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
