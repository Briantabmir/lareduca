<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        "id",
        "title",
        "description",
        "teacher_id",
        "department_id",
        "created_at",
        "updated_at",
    ];

    // public function assignments()
    // {
    //     return $this->hasMany(Assignment::class);
    // }

}
