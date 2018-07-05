<?php

use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Departamento::class, 4)->create()->each(function($u) {
            $u->cursos()->save(factory(App\Curso::class)->make());
        });
    }
}
