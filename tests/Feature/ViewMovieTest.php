<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewMovieTest extends TestCase
{
    /** Test */

    public function test_the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/no_playing' => $this->fakeNowPlayingMovies(),
        ]);

        $response = $this->get('/');

        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Now Playing');
        $response->assertSee('Fake Now Playing Movie');
        //$response->assertSee('Action, Adventure, Science Fiction');

    }

    public function test_the_search_dropdown_works_correctly () {
        Http::fake([
            "https://api.themoviedb.org/3/search/movie?query=jumanji" => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
        ->assertDontSee('jumanji')
        ->set('search', 'jumanji')
        ->assertSee('jumanji');
    }

    private function fakeSearchMovies(){
       return Http::response([
        "results" => [
            "adult" => false,
            "backdrop_path" => "/1Rr5SrvHxMXHu5RjKpaMba8VTzi.jpg",
            "genre_ids" =>[
              12,
              18,
              9648,
              878,
              53,
            ],
            "id" => 634649,
            "original_language" => "en",
            "original_title" => "Jumanji",
            "overview" => "Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.",
            "popularity" => 10039.54,
            "poster_path" => "/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg",
            "release_date" => "2021-12-15",
            "title" => "Jumanji",
            "video" => false,
            "vote_average" => 8.4,
            "vote_count" => 3160
        ]
        ], 200);
    }

    private function fakePopularMovies(){
       return Http::response([
        "results" => [
            "adult" => false,
            "backdrop_path" => "/1Rr5SrvHxMXHu5RjKpaMba8VTzi.jpg",
            "genre_ids" =>[
              28,
              12,
              878,
            ],
            "id" => 634649,
            "original_language" => "en",
            "original_title" => "Fake Movie",
            "overview" => "Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.",
            "popularity" => 10039.54,
            "poster_path" => "/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg",
            "release_date" => "2021-12-15",
            "title" => "Fake Movie",
            "video" => false,
            "vote_average" => 8.4,
            "vote_count" => 3160
        ]
        ], 200);
    }

    private function fakeNowPlayingMovies(){
       return Http::response([
        "results" => [
            "adult" => false,
            "backdrop_path" => "/1Rr5SrvHxMXHu5RjKpaMba8VTzi.jpg",
            "genre_ids" =>[
              28,
              12,
              878,
            ],
            "id" => 634649,
            "original_language" => "en",
            "original_title" => "Fake Now Playing Movie",
            "overview" => "Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.",
            "popularity" => 10039.54,
            "poster_path" => "/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg",
            "release_date" => "2021-12-15",
            "title" => "Fake Now Playing Movie",
            "video" => false,
            "vote_average" => 8.4,
            "vote_count" => 3160
        ]
        ], 200);
    }
}
