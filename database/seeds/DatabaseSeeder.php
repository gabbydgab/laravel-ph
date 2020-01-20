<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);

        if (App::environment('local')) {
            $this->call(FakeUsersTableSeeder::class);
            $this->call(FakeArticlesTableSeeder::class);
            $this->call(FakeEventsTableSeeder::class);
        }
    }
}
