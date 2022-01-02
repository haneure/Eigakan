<div>
    <div class="mt-8">
        <a href="{{ url('tv', $tvshow['id']) }}">
            <img src={{ $tvshow['poster_path'] }} alt="Poster" class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
        <div class="mt-2">
            <a href="{{ url('tv.show', $tvshow['id']) }}" class="text-lg mt-2 hover::text-gray:300">{{ $tvshow['name'] }}</a>
            <div class="flex items-center text-gray-400 text-sm mt-1">
                <span>
                    <img class="fill-current text-orange-500 w-4" src="https://img.icons8.com/fluency/50/000000/filled-star.png"/>
                </span>
                <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $tvshow['first_air_date'] }}</span>
            </div>
            <div class="text-gray-400 text-sm">
                {{-- {{ $tvshow['genres'] }} --}}
            </div>
        </div>
    </div>
</div>
