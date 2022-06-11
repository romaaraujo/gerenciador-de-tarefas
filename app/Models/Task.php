<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Task extends Model
{
    use HasFactory, Uuids;

    public $fillable = [
        'name',
        'description',
        'status',
        'file_url'
    ];

    public static $status = [
        'backlog',
        'in_progress',
        'waiting_customer_approval',
        'approved'
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
