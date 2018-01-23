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
      $CAT = false;   
      return view('index',['CAT'=>$CAT]);
    }

    public function category(Request $request)
    {
      $CAT = true;
      return view('index',['CAT'=>$CAT,'category_id'=>$request->input('category_id')]);
    }

    public function search(Request $request)
    {
      $CAT = false;
      $SEARCH = true;
      $movie_id_list = DB::table('movies')->where('title','like', '%'.$request->input('keyword').'%' )->pluck('id');
      return view('index',['CAT'=>$CAT,'SEARCH'=>$SEARCH,'movie_id_list'=>$movie_id_list]);
      
    }

}