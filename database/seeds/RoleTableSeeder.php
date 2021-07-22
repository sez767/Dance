<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles') -> insert ([
            'name' => 'Admin',
            'label' => 'Адмін'
        ]);
        DB::table('roles') -> insert ([
            'name' => 'Moderator',
            'label' => 'Модератор'
        ]);
        DB::table('roles') -> insert ([
            'name' => 'User',
            'label' => 'Користувач',
        ]);
        DB::table('roles')->insert([
            'name' => 'School_Master',
            'label' => 'Викладач',
        ]);

    }

}
