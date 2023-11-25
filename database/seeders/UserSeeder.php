<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'  => 'Rouhollah Mazarei',
            'email' => 'rouhollah@gmail.com',
            'password'  => bcrypt('1qaz@WSX'),
        ]);
        DB::table('users')->connection('dkdena_comment')->insert([
            'name'  => 'Rouhollah Mazarei',
            'email' => 'rouhollah@gmail.com',
            'password'  => bcrypt('1qaz@WSX'),
        ]);
    }
}
