<div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="course_id">Course</label>
                <select wire:model="course_id" class="w-full px-3 py-2 border border-gray-300 rounded">
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
                @error('course_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded" wire:model="title">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea class="w-full px-3 py-2 border border-gray-300 rounded" wire:model="description"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="due_date">Due Date</label>
                <input type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded" wire:model="due_date">
                @error('due_date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 mr-2">Save Assignment</button>
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700" wire:click="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>
