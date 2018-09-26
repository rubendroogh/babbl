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

        DB::table('groups')->insert([
            [
                'name' => 'Plebs',
            ],
        ]);

        DB::table('group_users')->insert([
            [
                'group_id' => '1',
                'user_id'  => '1',
                'role'     => '1',
            ],
            [
                'group_id' => '1',
                'user_id'  => '2',
                'role'     => '1',
            ],
        ]);

        DB::table('messages')->insert([
            [
                'content'    => 'Hallo daar!',
                'group_id'   => '1',
                'user_id'    => '1',
                'read'       => '0',
                'type'       => 'string',
                'created_at' => '2018-09-26 15:07:38',
            ],
            [
                'content'    => 'Jij ook hallo!',
                'group_id'   => '1',
                'user_id'    => '2',
                'read'       => '0',
                'type'       => 'string',
                'created_at' => '2018-09-26 15:07:38',
            ],
        ]);
    }
}
