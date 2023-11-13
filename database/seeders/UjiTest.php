<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use DB;
use Illuminate\Database\Seeder;

class UjiTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('patients')->insert([
                'birthdate' => $faker->dateTime(),
                'date_in' => $faker->dateTime(),
                'date_out' => $faker->dateTime(),
                'medrec' => $faker->randomDigitNot(10),
                'no_order' => $faker->randomDigitNot(10),
                'patient_name' => $faker->name(),
                'doctor' => $faker->name(),
     
                'no_sep' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
