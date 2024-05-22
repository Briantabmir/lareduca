<div> 
    <h2>Progress in Course: {{ $courseId }}</h2> 
    <h3>Assignments</h3> 
    @foreach($assignments as $assignment) 
        <div> 
            <p>{{ $assignment->title }}</p> 
            @php 
                $submission = $submissions->where('assignment_id', $assignment->id)->first(); 
            @endphp 
            @if($submission) 
            <p>Grade: {{ $submission->grade ?? 'Not graded yet' }}</p> 
            @else 
                <p>Status: Not submitted</p> 
            @endif 
        </div>
        @endforeach 
<h3>Game Participation</h3> 
@foreach($gameScores as $gameScore) 
<div> 
<p>Game: {{ $gameScore->game->title }} - Score: {{ 
$gameScore->score }}</p> 
</div> 
@endforeach 
</div>  
