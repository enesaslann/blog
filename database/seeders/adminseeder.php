<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('admin')->insert(
            [
                'name'=>'aslanx',
                'email'=>'enesaslan@gmail.com',
                'password'=>bcrypt(123456789),
            ]);
    }
}
