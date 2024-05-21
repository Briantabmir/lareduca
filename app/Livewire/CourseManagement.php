<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseManagement extends Component
{
    public $courses, $course_id, $title, $description, $teacher_id, $department_id;
    public $isModalOpen = false;

    public function mount() // This method is called when the component is initialized
    {
        $this->courses = Course::all();
    }

    public function render()
    {
        $this->courses = Course::all();
        return view('livewire.course-management');
    }

    public function create() 
    { 
        $this->resetCreateForm(); 
        $this->openModalPopover(); 
    } 

    public function openModalPopover() 
    { 
        $this->isModalOpen = true; 
    }

    public function closeModalPopover() 
    { 
        $this->isModalOpen = false; 
    } 
 
    private function resetCreateForm(){ 
        $this->title = ''; 
        $this->description = ''; 
        //$this->course_id = ''; 
    } 
 
    public function store() 
    { 
        $this->validate([ 
            'title' => 'required',
            'description' => 'required',
        ]);


        Course::updateOrCreate(['id' => $this->course_id], [ 
            'title' => $this->title, 
            'description' => $this->description,
        ]); 
 
        session()->flash('message', $this->course_id ? 'Course updated.' : 'Course created.'); 
        $this->closeModalPopover(); 
        $this->resetCreateForm(); 
    }

    public function edit($id) 
    { 
        $course = Course::findOrFail($id); 
        $this->course_id = $id; 
        $this->title = $course->title; 
        $this->description = $course->description; 
 
        $this->openModalPopover(); 
    } 
 
    public function delete($id) 
    { 
        Course::find($id)->delete(); 
        session()->flash('message', 'Course deleted.'); 
    } 

}




