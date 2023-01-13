<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $api_url = config('services.tmdb.endpoint').'trending/movie/day'. '?api_key='.config('services.tmdb.api');
            $response = Http::get($api_url);
            $data = null;












































            
            if ($response->status() == 201) {
                $data = $response->json();

                foreach ($data['results'] as $item) {
                    $movie_db = Movie::where('movie_id', $item['id'])->first();

                    if (!$movie_db) {
                        Movie::create([
                            'movie_id' => $item['id'],
                            'title' => $item['title'],
                            'overview' => $item['overview'],
                            'poster_path' => $item['poster_path'],
                            'release_date' => $item['release_date']
                        ]);
                    }
                }
            }

            return view('welcome', compact('data'));
        }

        return view('welcome');
    }

    public function movie($movie_id)
    {
        $data = Movie::where('movie_id', $movie_id)->first();

        if (!$data) {
            return redirect('/');
        }

        return view('movie', compact('data'));
    }
}
