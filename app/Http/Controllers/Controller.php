<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {

        $movies = null;
        $sort = request('sort', null);
        $up = request('up', null);
        if (($sort === 'price' || $sort === 'title') && ($up === '1' || $up === '0')) {
            $movies = Db::select("SELECT * FROM (SELECT * FROM sd_movies WHERE active = 1 ORDER BY id DESC LIMIT 8) t1 ORDER BY t1.$sort ".($up == 1 ? 'ASC' : 'DESC'));
        }
        else {
            $movies = Movie::where('active',1)->orderBy('id', 'desc')->take(8)->get();
        }

        return view('index', [
            'movies' => $movies
        ]);
    }

    public function delivery() {
        return view('delivery');
    }

    public function contacts() {
        return view('contacts');
    }

    public function section($id) {
        $genre = Genre::findOrFail($id);
        $movies = null;
        $sort = request('sort', null);
        $up = request('up', null);

        $movies = Movie::where('active',1)->where('genre_id', $genre->id);

        if (($sort === 'price' || $sort === 'title') && ($up === '1' || $up === '0')) {
            $movies->orderBy($sort, ($up == 1 ? 'asc' : 'desc'));
        }

        return view('section', [
            'movies' => $movies->get(),
            'genre' => $genre
        ]);
    }
}
