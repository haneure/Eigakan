<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topTv;
    public $genres;

    public function __construct($popularTv, $topTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topTv = $topTv;
        $this->genres = $genres;
    }

    public function popularTv() {
        return $this->formatTv($this->popularTv);
    }

    public function topTv() {
        return $this->formatTv($this->topTv);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv) {
        return collect($tv)->map(function ($tvshow) {

            $formattedGenres = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'],
                'vote_average'  => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $formattedGenres,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }
}
