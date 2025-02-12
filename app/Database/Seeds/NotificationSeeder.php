<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0;$i < 15; $i++) {
            $time = $faker->time('H:i');
            $start_at = Time::parse($time);
            $end_at = $start_at->addHours($faker->numberBetween(1, 4));
            
            $data = [
                'guestbook_id'      => $faker->numberBetween(1, 15),
                'status'            => $faker->numberBetween(0,3),
                'date'              => $faker->date('Y:m:d'),
                'start_at'          => $start_at->toTimeString(),
                'end_at'            => $end_at->toTimeString(),
                'updated_at'        => $faker->dateTimeBetween('2018-01-01', '2025-02-04')->format('Y-m-d H:i:s')
            ];

            $this->db->table('notifications')->insert($data);
        }
    }
}
