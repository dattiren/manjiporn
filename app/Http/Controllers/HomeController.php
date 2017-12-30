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

}