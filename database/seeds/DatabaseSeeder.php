<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Friend;
use App\Comment;

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
        $max_posts_per_user = 7;
        $max_comments_per_post = 10;
        $comments_total = $usersCount * $max_comments_per_post;

        /* ROLES */
        
        DB::table('roles')->insert([
            'type' => 'admin',
            'id' => 1
        ]);

        DB::table('roles')->insert([
            'type' => 'user',
            'id' => 2
        ]);


        /*USERS*/
        for($i = 1; $i <= $usersCount; $i++){

            if($i == 1){
                $name = 'Arek Dobosz';
                $sex = 'm';
                $avatar = null;
                $role = 1;
            } else {
                $role = 2;
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
                'role' => $role,
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

            for($j = 1; $j < $faker->numberBetween($min = 1, $max_posts_per_user); $j++) {
                $content = $faker->realText($maxNbChars = 200, $indexSize = 2);
                $post_id = $j;
                DB::table('posts')->insert(array(
                    'user_id' => $i,
                    'content' => $content,
                    'created_at' => $faker->dateTimeThisYear($max = 'now')
                ));
            }

        }
        /* COMMENTS */

        for($comment_id = 1; $comment_id < $comments_total; $comment_id++) {
            DB::table('comments')->insert(array(
                'post_id' =>$faker->numberBetween(1, $max_posts_per_user * $usersCount / 2),
                'author_id' => $faker->numberBetween(1, $usersCount),
                'content' => $faker->realText($maxNbChars = 100, $indexSize = 2)
            ));
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
