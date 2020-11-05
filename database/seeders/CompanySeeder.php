<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = array(
            array(
                'name' => 'T Shirt & Sons Ltd',
                'location' => '9-12 Washington Road',
                'city' => 'Wiltshire',
                'phone' => '+441373301645'
            ),
            array(
                'name' => 'Nottingham Playhouse',
                'location' => 'Wellington Circus',
                'city' => 'Nottingham',
                'phone' => '+441159419419'
            ),
            array(
                'name' => 'Fitzbillies',
                'location' => '51-52 Trumpington St',
                'city' => 'Cambridge',
                'phone' => '+441223352500'
            ),
        );

        DB::table('companies')->insert($companies);
    }
}
