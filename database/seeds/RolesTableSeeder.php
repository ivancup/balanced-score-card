<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'GERENTE']);
        Role::create(['name' => 'FUNCIONARIO_RRHH']);
        Role::create(['name' => 'SUPERVISOR']);

    }
}
