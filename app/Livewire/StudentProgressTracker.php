<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\GameScore;
use Illuminate\Support\Facades\Auth;

class StudentProgressTracker extends Component
{
    public $courseId;
    public $assignments = [];
    public $submissions = [];
    public $gameScores = [];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->loadData();
    }

    public function loadData()
    {
        // Obtener las asignaciones del curso
        $this->assignments = Assignment::where('course_id', $this->courseId)->get();
        
        // Obtener las entregas de asignaciones del estudiante
        $this->submissions = AssignmentSubmission::where('user_id', Auth::id())
            ->whereIn('assignment_id', $this->assignments->pluck('id'))
            ->get();
        
        // Obtener las puntuaciones de juegos del estudiante
        $this->gameScores = GameScore::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.student-progress-tracker');
    }
}

