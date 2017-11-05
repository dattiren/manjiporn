<?php

use Illuminate\Database\Seeder;
use App\Broad_category;

class BroadcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Broad_category::create([
            'name' => '未設定'
        ]);
        Broad_category::create([
            'name' => '女優'
        ]);
        //
    }
}
