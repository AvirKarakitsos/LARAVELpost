<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                "name_fr"=>"science",
                "name_en"=>"science",
            ],
            [
                "name_fr"=>"sport",
                "name_en"=>"sport",
            ],
            [
                "name_fr"=>"tech",
                "name_en"=>"digital"
            ],
            [
                "name_fr"=>"livre",
                "name_en"=>"book"
            ],
            [
                "name_fr"=>"philo",
                "name_en"=>"philo"
            ],
            [
                "name_fr"=>"musique",
                "name_en"=>"music",
            ],
            [
                "name_fr"=>"art",
                "name_en"=>"art"
            ],
            [
                "name_fr"=>"divers",
                "name_en"=>"other"
            ]
        ]);
    }
}
