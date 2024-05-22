<div class="container mx-auto p-6 bg-gray-100">
    <h1 class="text-3xl font-bold mb-6">Assignment Submissions</h1>

    <div class="mb-4">
        <form wire:submit.prevent="saveSubmission">
            <div class="mb-4">
                <label for="submission_text">Submission Text</label>
                <textarea id="submission_text" wire:model="submission_text" class="w-full px-3 py-2 border border-gray-300 rounded"></textarea>
                @error('submission_text') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="submission_file">File</label>
                <input type="file" id="submission_file" wire:model="submission_file" class="w-full px-3 py-2 border border-gray-300 rounded">
                @error('submission_file') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Submit</button>
        </form>
    </div>

    @foreach($submissions as $submission)
        <div class="bg-white p-4 rounded shadow mt-4">
            <h2 class="text-xl font-semibold">Submission by User ID: {{ $submission->user->name }}</h2>
            <p>{{ $submission->submission_text }}</p>
            @if($submission->submission_file)
                <a href="{{ Storage::url($submission->submission_file) }}" class="text-blue-500" target="_blank">View Submission</a>
            @endif
            <!-- Falta añadir la lógica para que los profesores califiquen y comenten hacer?? Preguntar
            a Elian-->
        </div>
    @endforeach
</div>
