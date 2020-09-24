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
        $user = new \App\User();

        $user->create([
            'name'     => 'Murtaza Vohra',
            'email'    => 'murtaza.vhora@hotmail.com',
            'password' => bcrypt(123456)
        ]);

        $user->create([
            'name'     => 'Mustafa Vohra',
            'email'    => 'mustafa.vhora@hotmail.com',
            'password' => bcrypt(123456)
        ]);
    }
}
