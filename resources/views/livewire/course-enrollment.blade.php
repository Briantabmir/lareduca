<div>
    <form wire:submit.prevent="enroll">
        <select wire:model="selectedCourseId">
            <option value="">Select a Course</option>
            @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->title }}</option>
            @endforeach
        </select>
        <button type="submit">Enroll</button>
    </form>

    @if(session()->has('message'))
    <div>{{ session('message') }}</div>
    @endif

    
    <h2>Enrollments</h2>
    @foreach($enrollments as $enrollment)
    <div>
        <p>{{ $enrollment->user->name }} - {{ $enrollment->course->title }}</p>
    </div>
    @endforeach
    
</div>