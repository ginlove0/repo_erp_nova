<?php

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
        for($i = 0; $i < 500000; $i++) {
            \App\Models\Supplier::create(['name' => \Illuminate\Support\Str::random(10)]);

        }
        // $this->call(UsersTableSeeder::class);
    }
}
