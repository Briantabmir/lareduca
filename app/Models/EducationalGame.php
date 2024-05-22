<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalGame extends Model
{
    protected $fillable = [
        "id",
        "title",
        "description",
        "url",
        "subject_area",
        "created_at",
        "updated_at"
    ];



    use HasFactory;
}
