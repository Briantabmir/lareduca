<div class="container mx-auto p-6 bg-gray-100">
    <h1 class="text-3xl font-bold mb-6">Assignments</h1>
    @if(Auth::user()->role != 'student')
    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" wire:click="create()">Create New Assignment</button>
    @endif
    @if($isOpen)
        @include('livewire.create_assignment')
    @endif

    @foreach($assignments as $assignment)
    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
        <div class="bg-white p-4 rounded shadow mt-4">
            <h2 class="text-xl font-semibold">{{ $assignment->title }}</h2>
            <p>{{ $assignment->description }}</p>
            <p>Due Date: {{ $assignment->due_date }}</p>
            <div class="flex justify-end space-x-2 mt-2">
                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700" wire:click="edit({{ $assignment->id }})">Edit</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700" wire:click="delete({{ $assignment->id }})">Delete</button>
            </div>
        </div>
    @elseif(Auth::user()->role === 'student')
        <div class="bg-white p-4 rounded shadow mt-4">
            <h2 class="text-xl font-semibold">{{ $assignment->title }}</h2>
            <p>{{ $assignment->description }}</p>
            <p>Due Date: {{ $assignment->due_date }}</p>
            <div class="flex justify-end space-x-2 mt-2">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" wire:click="submit({{ $assignment->id }})">Submit</button>
            </div>
        </div>
    @endif
    @endforeach
</div>

