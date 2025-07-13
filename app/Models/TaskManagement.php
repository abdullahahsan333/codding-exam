<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskManagement extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    
    protected $casts = [
        'is_completed' => 'boolean',
    ];

    static function allTask()
    {
        return self::where('is_completed', 0)->select('id', 'title', 'is_completed')->get();
    }

}
