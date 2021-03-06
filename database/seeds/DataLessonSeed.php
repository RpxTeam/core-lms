<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DataLessonSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<30;$i++){
            \App\DataLesson::create([
                'view' => 1,
                'finish'=> Carbon::createFromTimeStamp($faker->dateTimeBetween('-90 days', 'now')->getTimestamp())->format('Y/m/d'),
                'user_id' => $faker->randomDigitNotNull,
                'course_id' => $faker->randomDigitNotNull,
                'lesson_id' => $faker->randomDigitNotNull,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
