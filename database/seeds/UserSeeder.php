<?php

use App\Location;
use App\User;
use App\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create()->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->create());
            $user->location()->associate(factory(Location::class)->create());
            $user->save();
        });

        $userId = DB::table('users')->insertGetId([
            'telephone' => '553995074',
            'telephone_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'activated' => true,
            'otp' => 987654
        ]);

        if ($userId) {
            DB::table('profiles')->insert([
                'first_name' => 'Komla',
                'last_name' => 'Adzam',
                'other_names' => '',
                'gender' => 'male',
                'blood_group' => 'A+',
                'mobile_money_name' => 'Komla Adzam',
                'mobile_money_number' => '0553995074',
                'email' => 'adzamkomla@gmail.com',
                'jurisdiction' => 'Accra',
                'user_id' => $userId
            ]);
        }
    }
}
