<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class pageseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert(
                [
                    'title' => $page,
                    'image' => 'https://picsum.photos/id/52/750/300',
                    'content' => " ",
                    'slug' => Str::slug($page, "-"),
                    'order' => $count,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
