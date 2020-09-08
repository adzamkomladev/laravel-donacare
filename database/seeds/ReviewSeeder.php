<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donations = \App\Donation::all();

        factory(\App\Review::class, 5)->create()->each(function ($review) use ($donations) {
            [$donation] = $donations->random(1)->all();
            $review->donation()->associate($donation);
            $review->user()->associate($donation->patient);
            $review->save();
        });
    }
}
