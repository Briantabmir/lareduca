<div class="container mx-auto p-4">
        <h3 class="text-2xl font-bold mb-4">Available Games</h3>
        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($games as $game)
                <li class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <a href="{{$game->url}}" class="block">
                        <img src="{{$game->cover_image}}" alt="{{ $game->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h4 class="text-lg font-semibold">{{ $game->title }}</h4>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>