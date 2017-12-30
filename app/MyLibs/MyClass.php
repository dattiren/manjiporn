<?php namespace App\MyLibs;
use DB;

class MyClass{

    public function getCategoriesByMovieId($movie_id){
      $categories = DB::table('movies_categories')
        ->leftJoin('categories', 'movies_categories.category_id', '=', 'categories.id')
        ->where('movies_categories.movie_id', $movie_id )->pluck('categories.name');
      return $categories;
    }

    public function getCategories(){
      $categories = DB::table('categories')->get();
      return $categories;
    }
    
    
    public function getNewMovies(){
      $movies = DB::table('movies')->limit(12)->get();
      return $movies;
    }

    public function getMoviesByCat($category_id){
      $movies = 
        DB::table('movies')->leftJoin('movies_categories', 'movies.id', '=', 'movies_categories.movie_id')
        ->select('movies.id','movies.title', 'movies.url', 'movies.played_count')
        ->where('movies_categories.category_id', $category_id )
        ->limit(12)->get();

        return $movies;
    }

}

?>