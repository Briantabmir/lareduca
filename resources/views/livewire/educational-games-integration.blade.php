<div> 
    <h3>Available Games</h3> 
    <ul> 
        @foreach($games as $game) 
            <a href="{{$game->url}}"><li>{{ $game->title }}</li> </a> 
        @endforeach 
    </ul> 

</div> 