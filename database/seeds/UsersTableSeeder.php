<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Floris S. Koch',
            'email' => 'floriskoch@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);

        // Create 25 users with 4 listings each
        factory(App\User::class, 25)->create()->each(function ($user) {
            $user->listings()->saveMany(factory(App\Listing::class, 4)->make());

            $user->listings()->each(function($listing) {
                $listing->image()->save(factory(App\ListingImage::class)->make());
            });

            $user->userProfile()->save(factory(App\UserProfile::class)->make());
        });

    }
}
