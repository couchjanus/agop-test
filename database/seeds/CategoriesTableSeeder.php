<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Books'],
            ['name' => 'Reader'],
            ['name' => 'Textbooks'],
            ['name' => 'Computer'],
            ['name' => 'Electronics'],
            ['name' => 'TV'],
            ['name' => 'Mobile'],
        ];
        
        foreach($categories as $category)
        {
            \App\Category::create($category);
        }
    }
}
