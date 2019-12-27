<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('category_product')->truncate();

        $categories = [
            [ 1, 6, 10, 11 ],
            [ 2, 5, 12, 14 ],
            [ 3, 4, 9, 13 ],
            [ 7, 15, 12, 14, 18 ],
            [ 8, 16, 19],
            [ 13, 14, 17, 20 ],
            [ 15, 9, 10, 18 ],
        ];

        for ($i=0; $i<count($categories); $i++) {
            foreach ($categories[$i] as $j) {
                DB::table('category_product')->insert(
                    ['category_id' => $i+1, 'product_id' => $j]
                );
            }
        }
    }
}
