<?php namespace App\MyLibs;
use DB;

class MyClass{

    public function getCategories($movie_id){
      $categories = DB::table('movies_categories')->leftJoin('categories', 'movies_categories.category_id', '=', 'categories.id')->where('movies_categories.movie_id', $movie_id )->pluck('categories.name');
      return $categories;
    }

}

?>