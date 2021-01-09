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
        $this->call(categoryseeder::class);
        $this->call(contentseeder::class);
        $this->call(pageseeder::class);
        $this->call(adminseeder::class);
        $this->call(configseeder::class);
    }
}
