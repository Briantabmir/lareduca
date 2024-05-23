<div class="min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/Fondo.png') }}');">
        <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-lg w-full">
            <form wire:submit.prevent="enroll" class="mb-6">
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Select a Course</label>
                <select wire:model="selectedCourseId" id="course" class="block w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 text-gray-700 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Enroll</button>
            </form>

            @if(session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <h2 class="text-xl font-semibold mb-4">Enrollments</h2>
            <div class="space-y-4">
                @foreach($enrollments as $enrollment)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="text-gray-700"><strong>{{ $enrollment->user->name }}</strong> - {{ $enrollment->course->title }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>