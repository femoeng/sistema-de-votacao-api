<?php

use Illuminate\Database\Seeder;

class CriterioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Criterio::class, 3)->create();
    }
}
