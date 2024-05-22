<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'score',
    ];

    public function session()
    {
        return $this->belongsTo(GameSession::class, 'session_id');
    }

}
