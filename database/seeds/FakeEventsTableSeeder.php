<?php

use App\Event;
use Illuminate\Database\Seeder;

class FakeEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 20)->create();
    }
}
