@extends('layouts.main')

@section('container')
    <div class="movie-info border-b border-gray-800">
        <div class="div container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src={{ $movie['poster_path'] }} alt="joker" class="w-64 lg:w-96" style="width: 24rem">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span>
                        <img class="fill-current text-orange-500 w-4" src="https://img.icons8.com/fluency/50/000000/filled-star.png"/>
                    </span>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $movie['genres'] }}
                    </span>
                </div>

                <p class="text-gray-300 mt-8">{{ $movie['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Cast</h4>
                    <div class="flex flex-wrap mt-4">
                        @foreach ( $movie['crew'] as $crew)
                            <div class="flex mr-8">
                                @if($crew['profile_path'])
                                    <img src={{ 'https://image.tmdb.org/t/p/w500/' . $crew['profile_path'] }} alt="crew" class="w-8">
                                @else
                                    <img src='https://via.placeholder.com/50x70' alt="crew" class="w-8">
                                @endif
                                <div class="mt-2">
                                    <div class="text-sm hover::text-gray:300">&nbsp; {{ $crew['name'] }}</div>
                                    <div class="text-gray-400 text-sm">&nbsp; {{ $crew['job'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ isOpen: false }">
                    @if(count($movie['videos']['results']) > 0)
                        <div class="mt-12">
                            <button
                            @click="isOpen = true"
                            href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                                <img class="w-6 fill-current" src="https://www.svgrepo.com/show/13672/play-button.svg" alt="">
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>



                    @endif
                    <template x-if.transition.opacity="isOpen">
                        <div
                            style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            @click="isOpen = false"
                                            @keydown.escape.window="isOpen = false"
                                            class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ( $movie['cast'] as $cast)
                    <div class="mt-8">
                        <a href="/actors/{{ $cast['id'] }}">
                            <img src={{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }} alt="joker" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="/actors/{{ $cast['id'] }}" class="text-lg mt-2 hover::text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="movie-images border-b border-gray-800" x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl">Screenshots</h2>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ( $movie['images'] as $image)
                    <div class="mt-8">
                        <a
                        @click.prevent="
                        isOpen = true
                        image = '{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'
                        "
                        href="#">
                            <img src={{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }} alt="Screenshots" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>
                @endforeach

                <template x-if.transition.opacity="isOpen">
                    <div
                        style="background-color: rgba(0, 0, 0, .5);"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button
                                        @click="isOpen = false"
                                        @keydown.escape.window="isOpen = false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                    </button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                    <img :src="image" alt="poster">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>

@endsection
