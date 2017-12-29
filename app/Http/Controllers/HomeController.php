<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
 
class HomeController extends Controller
{
    public function index(Request $request)
    {
      $movies = DB::table('movies')->limit(12)->get();

      //$categories = DB::table('movies_categories')->leftJoin('categories', 'movies_categories.category_id', '=', 'categories.id')->where('movies_categories.movie_id', $request->input('movie_id') )->pluck('categories.name');
      return view('index',[ 'movies' =>$movies ]);
    }
}