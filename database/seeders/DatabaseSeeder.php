<?php

namespace Database\Seeders;

use App\Models\Post;
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
        $this->call(CategorySeeder::class);

        User::factory(5)->create()->each(function ($user){
            Post::factory(rand(1,3))->create([
                'user_id' => $user->id
            ]);
        });
    }
}
