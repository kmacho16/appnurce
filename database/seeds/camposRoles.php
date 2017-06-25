<?php

use Illuminate\Database\Seeder;

class camposRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert(
            [
                ['rol'=>'Administrador'],
                ['rol'=>'Prestador'],
                ['rol'=>'Visitante'],
            ]
            );
    }
}
