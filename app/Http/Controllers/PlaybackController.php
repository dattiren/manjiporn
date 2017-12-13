<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
 
class PlaybackController extends Controller
{
    public function index(Request $request)
    {
      $movie_data = DB::table('movies')->select('title', 'url', 'played_count')->where('id', $request->input('movie_id') )->get();

      $categories = DB::table('movies_categories')->leftJoin('categories', 'movies_categories.category_id', '=', 'categories.id')->where('movies_categories.movie_id', $request->input('movie_id') )->pluck('categories.name');
      return view('playback',['movie_data' => $movie_data[0], 'categories' =>$categories ]);
    }
}