<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'user_id',
        'start_time',
        'end_time',
    ];

    public function game()
    {
        return $this->belongsTo(EducationalGame::class, 'game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scores()
    {
        return $this->hasMany(GameScore::class, 'session_id');
    }

}
