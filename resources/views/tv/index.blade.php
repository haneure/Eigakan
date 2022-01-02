@extends('layouts.main')

@section('container')
    <div class="container mx-auto px-4 pt-16">
        {{-- Popular Movies --}}

        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow"/>
                @endforeach
            </div>
        </div>

        <div class="top-shows py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topTv as $tvshow)
                <x-tv-card :tvshow="$tvshow"/>
                @endforeach
            </div>
        </div>

    </div>
@endsection
