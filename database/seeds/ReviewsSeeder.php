<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\ProductReview;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $review = new ProductReview();
        $review->user_id = User::where('username', 'lexington')->first()->id;
        $review->product_id = Product::where('name', 'HTML Desc Test')->first()->id;
        $review->message = "This product is alright, I guess...";
        $review->rating = 3;
        $review->save();

        $review = new ProductReview();
        $review->user_id = User::where('username', 'enterprise')->first()->id;
        $review->product_id = Product::where('name', 'HTML Desc Test')->first()->id;
        $review->message = "This product is pretty neat!";
        $review->rating = 4;
        $review->save();
    }
}
