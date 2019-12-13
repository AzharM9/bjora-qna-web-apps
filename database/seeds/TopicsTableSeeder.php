<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('topics')->insert([
            [
                'name' => 'Technology'
            ],
            [
                'name' => 'Science'
            ],
            [
                'name' => 'Sport'
            ],
            [
                'Name' => 'Culinary'
            ]
        ]);
    }
}
