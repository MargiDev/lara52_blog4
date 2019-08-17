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
        // Reset users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        // Insert 3 users
        DB::table('users')->insert([
          [
            'name' => 'Makara Chhin',
            'slug' => 'makara-chhin',
            'email' => 'makarachhin@test.com',
            'password' => bcrypt('secret')
          ],
          [
            'name' => 'Rotha Chhin',
            'slug' => 'rotha-chhin',
            'email' => 'rothachhin@test.com',
            'password' => bcrypt('secret')
          ],
          [
            'name' => 'Va Dara',
            'slug' => 'va-dara',
            'email' => 'data@test.com',
            'password' => bcrypt('secret')
          ]
        ]);
    }
}
