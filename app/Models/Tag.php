<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Uuids;

    protected $table = 'tasks_tag';

    public $fillable = [
        'task_id',
        'tag_name'
    ];
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
