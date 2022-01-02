<div
    class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 rounded-full w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline" placeholder="Search Movies ( Press '/' )"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.alt.tab="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >

    <div class="absolute top-0">
        <img class="fill-current text-gray-500 w-4 mt-2 ml-2" src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/32/000000/external-search-ui-dreamstale-lineal-dreamstale.png"/>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if (strlen($search) >= 1)
        <div
            class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
            x-show.transition.opacity="isOpen"
            @keydown.escape.window="isOpen = false"
            >
                @if ($searchResults->count() > 0)
                    <ul>
                        @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a
                                href={{ 'movies/'. $result['id'] }}
                                class="block hover:bg-gray-700 mt-0 mb-0 px-3 py-3 flex items-center"
                                @if ($loop->last)
                                    @keydown.tab="isOpen = false"
                                @endif
                                >
                            @if ($result['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="Poster" class="w-8">
                            @else
                            <img src="https://via.placeholder.com/50/75" alt="Poster" class="w-8">
                            @endif
                            <span class="ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="div px-3 py-3">No results for "{{ $search }}"</div>
                @endif
        </div>
    @endif
</div>
