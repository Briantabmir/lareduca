<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // para cargar archivos
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class AssignmentSubmissions extends Component
{
    use WithFileUploads;

    public $assignments, $submissions, $assignment_id, $submission_text, $submission_file, $submission_id;

    public function mount($assignmentId)
    {
        $this->assignment_id = $assignmentId;
        $this->loadSubmissions();
        $this->assignments = Assignment::all();
    }

    public function loadSubmissions()
    {
        $this->submissions = AssignmentSubmission::where('assignment_id', $this->assignment_id)->get();
    }

    public function saveSubmission()
    {
        $this->validate([
            'submission_text' => 'nullable|string',
            'submission_file' => 'nullable|file|max:10240', // 10MB Max
        ]);

        $submission = new AssignmentSubmission();
        $submission->assignment_id = $this->assignment_id;
        $submission->user_id = Auth::id(); // Asumiendo que el usuario está autenticado
        $submission->submission_text = $this->submission_text;

        if ($this->submission_file) {
            $filePath = $this->submission_file->store('submissions', 'public');
            $submission->submission_file = $filePath;
        }

        $submission->save();

        $this->reset(['submission_text', 'submission_file']); // Limpiar campos
        $this->loadSubmissions(); // Recargar entregas
    }

    public function render()
    {
        return view('livewire.assignment-submissions');
    }
}

