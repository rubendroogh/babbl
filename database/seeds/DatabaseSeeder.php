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
        DB::table('users')->insert([
            [
                'name' => 'Renze',
                'email' => 'renze@test.nl',
                'password' => bcrypt('test123'),
            ],
            [
                'name' => 'Ruben',
                'email' => 'ruben@test.nl',
                'password' => bcrypt('test123'),
            ],
        ]);
    }
}
