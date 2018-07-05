<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Criterio::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->titleMale
    ];
});

$factory->define(App\Curso::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->company,
        'SLUG' => $faker->slug,
    ];
});

$factory->define(App\Departamento::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->city,
        'id' => $faker->ipv4
    ];
});

$factory->define(App\Projectista::class, function (Faker\Generator $faker) {
    return [
        'numero_estudante' => $faker->numberBetween(1000,200000),
        'nome' => $faker->firstName,
        'numero_celular' => $faker->phoneNumber
    ];
});

$factory->define(App\Projecto::class, function (Faker\Generator $faker) {

    return [
        'titulo' => $faker->title,
        'area_aplicacao' => $faker->companySuffix,
        'descricao' => "Descricao de projecto",
        'imagem' => $faker->address,
        'tutor' => $faker->firstName,
    ];
});

$factory->define(App\Utilizador::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'senha' => $faker->password,
        'privilegio' => "admin",
    ];
});

$factory->define(App\Visitante::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'tipo_documento' => "B.I",
        'numero_documento' => $faker->numerify('###########'),
        'contacto' => $faker->phoneNumber,
        'email' => $faker->email,
        'tipo_visitante' => "Estudante"|"Investidor",
        'pin' => $faker->creditCardNumber,
        'codigo' => $faker->creditCardNumber,
    ];
});
