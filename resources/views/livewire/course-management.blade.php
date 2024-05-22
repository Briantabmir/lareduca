<div class="container mx-auto p-6 bg-gray-100">
    <h1 class="text-3xl font-bold mb-6">Cursos</h1>
    @if(Auth::user()->role != 'student')
    <button class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-700" wire:click="create">Crear Curso</button>
    @endif
    @if($isModalOpen) 
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <form wire:submit.prevent="store"> 
                <div class="mb-4">
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded" wire:model="title" placeholder="Title"> 
                </div>
                <div class="mb-4">
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded" wire:model="description" placeholder="Description"></textarea> 
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded hover:bg-green-700 mr-2">Save Course</button> 
                    <button type="button" class="bg-red-500 text-black px-4 py-2 rounded hover:bg-red-700" wire:click="closeModalPopover()">Cancel</button> 
                </div>
            </form> 
        </div>
    </div> 
    @endif 

    <div class="mt-6 space-y-4">
        @foreach($courses as $course)
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher') 
        <div class="bg-white p-4 rounded shadow">
            <h4 class="text-xl font-semibold">{{ $course->title }}</h4> 
            <p class="text-gray-700">{{ $course->description }}</p>
            <div class="flex justify-end space-x-2 mt-2">
                <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700" wire:click="edit({{ $course->id }})">Edit</button> 
                <button class="bg-red-500 text-black px-4 py-2 rounded hover:bg-red-700" wire:click="delete({{ $course->id }})">Delete</button> 
                
            </div>
        </div>
        @elseif(Auth::user()->role === 'student')
        <div class="bg-white p-4 rounded shadow">
            <h4 class="text-xl font-semibold">{{ $course->title }}</h4> 
            <p class="text-gray-700">{{ $course->description }}</p>
        </div>
        @endif 
        @endforeach 
    </div>
</div> 
