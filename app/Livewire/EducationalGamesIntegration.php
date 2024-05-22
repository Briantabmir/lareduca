<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EducationalGame;
use App\Models\GameSession;
use App\Models\GameScore;
use Illuminate\Support\Facades\Auth;

class EducationalGamesIntegration extends Component
{
    public $games;
    public $selectedGameId;
    public function mount()
    {
        $this->games = EducationalGame::all();
    }

    


    public function render()
    {
        return view('livewire.educational-games-integration');
    }
}
