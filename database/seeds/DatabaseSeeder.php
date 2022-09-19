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
        // $this->call(UsersTableSeeder::class);

        App\User::create([
            'name' => 'Erasmo Martinez',
            'email' => 'i@admin.com',
            'password' => bcrypt('123456') //Método para encriptar la contraseña
        ]);

        factory(App\Post::class, 24)->create();
    }
}
