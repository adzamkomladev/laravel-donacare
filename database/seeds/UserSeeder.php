<?php

use App\Location;
use App\User;
use App\Profile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->create());
            $user->location()->save(factory(Location::class)->create());
        });
    }
}
