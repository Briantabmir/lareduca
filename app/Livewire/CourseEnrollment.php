<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class CourseEnrollment extends Component
{

    public $courses;
    public $selectedCourseId;
    public $enrollments;

    public function mount()
    {
        $this->courses = Course::all();
        $this->loadEnrollments();
    }

    public function loadEnrollments()
    {
        
            $this->enrollments = \App\Models\CourseEnrollment::where('user_id', Auth::id())->with('course')->get();
        
    }

    public function enroll()
    {
        $this->validate([
            'selectedCourseId' => 'required',
        ]);

        \App\Models\CourseEnrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $this->selectedCourseId,
            'enrollment_date' => now(),
            'status' => 'enrolled', // Considerar distintos estados 
        ]);


        session()->flash('message', 'Successfully enrolled in the course.');
    }

    public function render()
    {
        return view('livewire.course-enrollment');
    }
}
