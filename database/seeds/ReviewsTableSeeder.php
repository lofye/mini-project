<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Review::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = date('Y-m-d H:i:s', time());

        $review = new Review();
        $review->title = 'Pretty Good';
        $review->content = 'Tastes just like the fast food you\'re used to, but is vegan. Nice.';
        $review->value = 7;
        $review->user_id = 1;
        $review->restaurant_id = 1;
        $review->created_at = $now;
        $review->updated_at = $now;
        $review->save();

        $review = new Review();
        $review->title = 'SO Delicious!';
        $review->content = 'OMG. I can\'t believe there\'s no meat in this!';
        $review->value = 8;
        $review->user_id = 2;
        $review->restaurant_id = 2;
        $review->created_at = $now;
        $review->updated_at = $now;
        $review->save();

        $review = new Review();
        $review->title = 'Even Better';
        $review->content = 'I went back a week later, and the food was even better than last time.';
        $review->value = 9;
        $review->user_id = 2;
        $review->restaurant_id = 2;
        $review->created_at = $now;
        $review->updated_at = $now;
        $review->save();
    }
}
