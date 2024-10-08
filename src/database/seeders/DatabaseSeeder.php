<?php

namespace Database\Seeders;

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
        $this->call(user_propertysTableSeeder::class);
        $this->call(genresTableSeeder::class);
        $this->call(regionsTableSeeder::class);
        $this->call(shoptimesTableSeeder::class);
        $this->call(usersTableSeeder::class);
        $this->call(shopsTableSeeder::class);
        $this->call(adminsTableSeeder::class);
        $this->call(shopadminsTableSeeder::class);
        $this->call(conditionsTableSeeder::class);
        $this->call(reviewsTableSeeder::class);
        $this->call(shoptestsTableSeeder::class);
    }
}
