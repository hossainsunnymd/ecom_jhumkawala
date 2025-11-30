<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = database_path('location/countries.sql');
        $states = database_path('location/states.sql');
        $cities = database_path('location/cities.sql');

        if (!file_exists($countries)) {
            return;
        } else if (!file_exists($states)) {
            return;
        } else if (!file_exists($cities)) {
            return;
        } else {
            DB::unprepared(file_get_contents($countries));
            DB::unprepared(file_get_contents($states));
            DB::unprepared(file_get_contents($cities));
        }
    }
}
