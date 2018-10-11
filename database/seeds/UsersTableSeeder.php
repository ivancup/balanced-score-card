<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Liz',
            'lastname' => 'Quintero',
            'email' => 'liz@alpina.com',
            'password' => bcrypt('123456'),
            'id_estado' => '1'
        ]);
        $user1->assignRole('GERENTE');

        $user2 = User::create([
            'name' => 'Dan',
            'lastname' => 'Zero',
            'email' => 'dan@alpina.com',
            'password' => bcrypt('123456'),
            'id_estado' => '1'
        ]);
        $user2->assignRole('FUNCIONARIO_RRHH');

        $user2 = User::create([
            'name' => 'Leo',
            'lastname' => 'S. Kenedy',
            'email' => 'leo@alpina.com',
            'password' => bcrypt('123456'),
            'id_estado' => '1'
        ]);
        $user2->assignRole('SUPERVISOR');
    }
}
