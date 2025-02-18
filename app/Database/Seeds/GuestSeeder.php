<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GuestSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0;$i < 15; $i++) {
            $picName = $faker->name();

            $time = $faker->time('H:i');
            $start_at = Time::parse($time);
            $end_at = $start_at->addHours($faker->numberBetween(1, 4));

            $data = [
                'institution_name'  => $faker->company(),
                'pic_name'          => $picName,
                'phone_number'      => $faker->phoneNumber(),
                'employee_id'       => $faker->numberBetween(1, 15),
                'agenda'            => $faker->sentence(5),
                'identity_photo'    => $picName . '.jpg',
                'room_id'           => $faker->numberBetween(1,15),
                'status'            => $faker->numberBetween(0,2),
                'date'              => $faker->dateTimeBetween('2025-02-16', '2025-02-17')->format('Y-m-d'),
                'start_at'          => $start_at->toTimeString(),
                'end_at'            => $end_at->toTimeString(),
                'created_at'        => $faker->dateTimeBetween('2024-12-11', '2025-01-11')->format('Y-m-d H:i:s'),
                'updated_at'        => Time::now('Asia/Jakarta')
            ];

            $this->db->table('guestbooks')->insert($data);
        }
    }
}
