<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Restaurant::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = date('Y-m-d H:i:s', time());

        $restaurant = new Restaurant();
        $restaurant->name = 'Globally Local';
        $restaurant->description = 'Canada\'s First Vegan Fast-food Restaurant';
        $restaurant->user_id = 1;
        $restaurant->created_at = $now;
        $restaurant->updated_at = $now;
        $restaurant->save();

        $restaurant = new Restaurant();
        $restaurant->name = 'Plant Matter Kitchen';
        $restaurant->description = 'London\'s Finest Vegan Cuisine';
        $restaurant->user_id = 2;
        $restaurant->created_at = $now;
        $restaurant->updated_at = $now;
        $restaurant->save();

        $restaurant = new Restaurant();
        $restaurant->name = 'McDonald\'s';
        $restaurant->description = 'The Golden Arches';
        $restaurant->user_id = 2;
        $restaurant->created_at = $now;
        $restaurant->updated_at = $now;
        $restaurant->save();
    }
}
