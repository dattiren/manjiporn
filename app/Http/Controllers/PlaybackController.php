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
      $CAT = false;   
      $movie_data = DB::table('movies')->select('id','title', 'url', 'played_count')->where('id', $request->input('movie_id') )->get();
      
      return view('playback',['movie_data' => $movie_data[0],'CAT' => $CAT]);
    }
}