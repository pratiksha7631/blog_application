<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
	$categories = array(
		array('id' => 1,'name' => "Career"),
		array('id' => 2,'name' => "News"),
		array('id' => 3,'name' => "Food"),
		array('id' => 4,'name' => "Travel"),

		);
		DB::table('categories')->insert($categories);
	}
}
