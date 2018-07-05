<?php

use Illuminate\Database\Seeder;

class ProjectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Projecto::class, 20)->create();

    }
}
