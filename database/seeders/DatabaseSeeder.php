<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Helpers\HelperFunctions;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'email' => "admin@admin.com",
            'password' => HelperFunctions::encryptValue('Password@1234'),
            'role' => "admin"
        ]);
        User::create([
            'email' => "user@user.com",
            'password' => HelperFunctions::encryptValue('Password@1234'),
            'role' => "user"
        ]);
        User::create([
            'email' => "user1@user.com",
            'password' => HelperFunctions::encryptValue('Password@1234'),
            'role' => "user"
        ]);

        Activity::create([
            "title" => "First of the lots",
            "description" => "kay Umbreall",
            "image" =>"image/he4uQ3gvRTZkDXqG7YbwBgABF7zaBkDb4E33iL97.jpg",
            "user_id" => "2",
            "date" => "26/10/2022",
            "type" => "N",
        ]);
        Activity::create([
            "title" => "Second of the lots",
            "description" => "kay Test",
            "image" =>"image/bhOdWLVTgjJUYrSf4Ia17Yy9DG53LB8s40i1skdY.jpg",
            "user_id" => "2",
            "date" => "27/10/2022",
            "type" => "N",
        ]);
        Activity::create([
            "title" => "First of the lots2",
            "description" => "kay Umbreall2",
            "image" =>"image/he4uQ3gvRTZkDXqG7YbwBgABF7zaBkDb4E33iL97.jpg",
            "user_id" => null,
            "date" => "25/10/2022",
            "type" => "G",
        ]);
        Activity::create([
            "title" => "First ofs the lots2",
            "description" => "kay Umbreall2",
            "image" =>"image/he4uQ3gvRTZkDXqG7YbwBgABF7zaBkDb4E33iL97.jpg",
            "user_id" => 3,
            "date" => "25/10/2022",
            "type" => "N",
        ]);
    }
}
