@extends('layouts.main')

@section('container')
    <div class="movie-info border-b border-gray-800">
        <div class="div container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}" alt="Profile" class="w-64 lg:w-96" style="width: 24rem">
                <ul class="flex items-center mt-4">
                    @if ($social['facebook'])
                        <li>
                            <a href="{{ $social['facebook'] }}" title="Facebook">
                                <img class="fill-current text-gray-400 hover:text-white w-8" src="https://img.icons8.com/ios-filled/344/ffffff/facebook--v1.png"/>
                            </a>
                        </li>
                    @endif
                    @if ($social['instagram'])
                    <li class="ml-6">
                        <a href="{{ $social['instagram'] }}" title="Instagram">
                            <img class="fill-current text-gray-400 hover:text-white w-8" src="https://img.icons8.com/nolan/344/ffffff/instagram-new.png"/>
                        </a>
                    </li>
                    @endif
                    @if ($social['twitter'])
                    <li class="ml-6">
                        <a href="{{ $social['twitter'] }}" title="Twitter">
                            <img class="fill-current text-gray-400 hover:text-white w-8" src="https://img.icons8.com/ios-filled/344/ffffff/twitter.png"/>
                        </a>
                    </li>
                    @endif
                    @if ($actor['homepage'])
                        <li class="ml-6">
                            <a href="{{ $actor['homepage'] }}" title="web">
                                <img class="fill-current text-gray-400 hover:text-white w-8" src="https://img.icons8.com/windows/344/ffffff/globe.png"/>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span>
                        <img class="fill-current text-gray-400 hover:text-white w-4" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/344/ffffff/external-birthday-cake-new-year-kiranshastry-solid-kiranshastry.png"/>
                    </span>
                    <span class="ml-2">{{ $actor['birthday'] }} ({{ $actor['age'] }} years old) in {{ $actor['place_of_birth'] }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $actor['biography'] }}
                </p>

                <h4 class="font-semibold mt-12">Known For</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                    @foreach ($knownForMovies as $movie)
                        <div class="mt-4">
                            <a href="{{ $movie['linkToPage'] }}">
                                <img class="hover:opacity-75 transition ease-in-out duration-150" alt="poster" src="{{ $movie['poster_path'] }}"/>
                            </a>
                            <a href="{{ $movie['linkToPage'] }}">{{ $movie['title'] }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="credits border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl">Credits</h2>
            <ul class="list-dics leading-loose pl-5 mt-8">
                @foreach ($credits as $credit)
                <li>{{ $credit['release_date'] }} &middot; <strong>{{ $credit['title'] }}</strong> as {{ $credit['character'] }}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
