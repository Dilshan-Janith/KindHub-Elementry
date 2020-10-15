<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'class_name'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'class_id');
    }
}
