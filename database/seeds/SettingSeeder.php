<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::ofRole('admin')->get()->each(function ($user) {
            DB::table('settings')->insert([
                'user_id' => $user->id,
                'data' => json_encode([
                    'system_charge' => 50,
                    'percentage_charge' => 15,
                    'duration_between_donation' => 180
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ]);
        });
    }
}
