<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pl_PL');

        $usersCount = 20;

        for($i = 1; $i <= $usersCount; $i++){

            if($i == 1){
                $name = 'Arek Dobosz';
                $sex = 'm';
            } else {
                $sex = $faker->randomElement(['m', 'f']);
                switch($sex){
                    case 'm' :
                            $name = $faker->firstNameMale.' '.$faker->lastNameMale;
                        break;

                    case 'f' : 
                            $name = $faker->firstNameFemale.' '.$faker->lastNameFemale;
                        break;

                }
            }

            DB::table('users')->insert(array(
                'name' => $name,
                'email' => str_replace('-', '', str_slug($name)).'@'.$faker->safeEmailDomain,
                'sex' => $sex,
                'password' => bcrypt('1234')
            ));
        }
    }
}
