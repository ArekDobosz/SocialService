<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;

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
                $avatar = null;
            } else {
                $sex = $faker->randomElement(['m', 'f']);
                switch($sex){
                    case 'm' :
                            $name = $faker->firstNameMale.' '.$faker->lastNameMale;
                            $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
                        break;

                    case 'f' : 
                            $name = $faker->firstNameFemale.' '.$faker->lastNameFemale;
                            $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
                        break;

                }
            }

            DB::table('users')->insert(array(
                'name' => $name,
                'email' => str_replace('-', '', str_slug($name)).'@'.$faker->safeEmailDomain,
                'sex' => $sex,
                'avatar' => $avatar,
                'password' => bcrypt('1234')
            ));
        }

        /* Friends */
        for($i = 1; $i < $usersCount; $i++) {

            /* FRIENDS */
            for($j = 0; $j < $faker->numberBetween($min = 1, $max = $usersCount / 2); $j++) {
                
                $friend_id = $faker->numberBetween($min = 1, $max = $usersCount);
    
                if(!$this->friend_exists($i, $friend_id)) {
    
                    DB::table('friends')->insert(array(
                        'user_id' => $i,
                        'friend_id' => $friend_id,
                        'accepted' => 1,
                        'created_at' => $faker->dateTimeThisYear($max = 'now')
                    ));
                }    
            }
            /* POSTS */

        }
        
    }

    private function friend_exists($user_id, $friend_id) {
        $result = Friend::where([
            'user_id' => $user_id,
            'friend_id' => $friend_id
        ])->exists();
    
        if(is_null($result)) {
            $result = Friend::where([
                'user_id' => $friend_id,
                'friend_id' => $user_id
            ])->exists();
        }
    
        return $result;
    }
}
