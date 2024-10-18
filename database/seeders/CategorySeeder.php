<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
        [
            'CategoryID' => 1,
            'CategoryName' => 'Cà phê',
            'Description' => '',
        ],
        [
            'CategoryID' => 2,
            'CategoryName' => 'Trái cây xay',
            'Description' => '',
        ],
        [
            'CategoryID' => 3,
            'CategoryName' => 'Trà trái cây - Hi Tea',
            'Description' => '',
        ],
        [
            'CategoryID' => 4,
            'CategoryName' => 'Trà sữa',
            'Description' => '',
        ],
        [
            'CategoryID' => 5,
            'CategoryName' => 'Trà xanh - Chocolate',
            'Description' => '',
        ],
        [
            'CategoryID' => 6,
            'CategoryName' => 'Thức uống đá xay',
            'Description' => '',
        ],
        [
            'CategoryID' => 7,
            'CategoryName' => 'Bánh & Snack',
            'Description' => '',
        ],
        [
            'CategoryID' => 8,
            'CategoryName' => 'Thưởng thức tại nhà',
            'Description' => '',
        ],
    ]);
}
}

