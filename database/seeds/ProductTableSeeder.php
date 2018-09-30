<?php

use Illuminate\Database\Seeder;

use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; $i++)
        {
        	$product = new Product([
        		'imagePath'=> 'https://via.placeholder.com/350x150',
        		'title' => 'Laravel Book ' . $i,
        		'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
        		'price'=> (10 + $i),
        	]);
        	$product->save();
        }
    }
}
