<?php

// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\Assignment;
// use App\Models\Course;

// class AssignmentsManagement extends Component
// {

//     public $assignments, $courses, $title, $description, $due_date, $course_id, $assignment_id; 
//     public $isOpen = false; 

//     public function mount() 
//     { 
//         $this->assignments = Assignment::all();
//         $this->courses = Course::all();
//     }


//     public function render()
//     {
//         $this->assignments = Assignment::where('course_id', $this->course_id)->get(); 
//         return view('livewire.assignments-management');
//     }

//     public function create() 
//     { 
//         $this->resetInputFields(); 
//         $this->openModal(); 
//     } 
 
//     public function openModal() 
//     { 
//         $this->isOpen = true; 
//     } 

//     public function closeModal() 
//     { 
//         $this->isOpen = false; 
//     } 

//     private function resetInputFields(){ 
//         $this->title = ''; 
//         $this->description = ''; 
//         $this->due_date = ''; 
//         $this->assignment_id = ''; 
//     } 

//     public function store() 
//     { 
//         $this->validate([ 
//             'title' => 'required', 
//             'description' => 'required', 
//             'due_date' => 'required|date', 
//         ]); 
 
//         Assignment::updateOrCreate(['id' => $this->assignment_id], [ 
//             'title' => $this->title, 
//             'description' => $this->description, 
//             'due_date' => $this->due_date, 
//             'course_id' => $this->course_id, 
//         ]); 
 
//         session()->flash('message',  
//             $this->assignment_id ? 'Assignment Updated Successfully.' : 
// 'Assignment Created Successfully.'); 
 
//         $this->closeModal(); 
//         $this->resetInputFields(); 
//     } 
 
//     public function edit($id) 
//     { 
//         $assignment = Assignment::findOrFail($id); 
//         $this->assignment_id = $id; 
//         $this->title = $assignment->title; 
//         $this->description = $assignment->description; 
//         $this->due_date = $assignment->due_date; 
 
//         $this->openModal(); 
//     } 
 
//     public function delete($id) 
//     { 
//         Assignment::find($id)->delete(); 
//         session()->flash('message', 'Assignment Deleted Successfully.'); 
//     } 

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class AssignmentsManagement extends Component
{
    public $assignments, $courses, $title, $description, $due_date, $course_id, $assignment_id;
    public $isOpen = false;

    public function mount()
    {
        $this->courses = Course::all();
        //$this->course_id = $this->courses->first()->id ?? null; // Asigna el primer curso o null si no hay cursos
        //$this->loadAssignments();
        
        $this->assignments = Assignment::all();
    }

    public function render()
    {
        return view('livewire.assignments-management', ['courses' => $this->courses]);
    }

    public function loadAssignments()
    {
        // if ($this->course_id) {
        //     $this->assignments = Assignment::where('course_id', $this->course_id)->get();
        // } else {
        //     $this->assignments = [];
        // }
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->due_date = '';
        $this->assignment_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'course_id' => 'required|integer',
        ]);

        Assignment::updateOrCreate(['id' => $this->assignment_id], [
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'course_id' => $this->course_id,
        ]);

        session()->flash('message', $this->assignment_id ? 'Assignment Updated Successfully.' : 'Assignment Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
        $this->loadAssignments(); // Recargar las asignaciones después de crear o actualizar una
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $this->assignment_id = $id;
        $this->title = $assignment->title;
        $this->description = $assignment->description;
        $this->due_date = $assignment->due_date;
        $this->course_id = $assignment->course_id;

        $this->openModal();
    }

    public function delete($id)
    {
        Assignment::find($id)->delete();
        session()->flash('message', 'Assignment Deleted Successfully.');
        $this->loadAssignments(); // Recargar las asignaciones después de eliminar una
    }

    public function submit($assignmentId)
    {
        return redirect()->route('assignment.submissions', ['assignmentId' => $assignmentId]);
    }

}

