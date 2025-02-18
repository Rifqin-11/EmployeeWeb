<?php

namespace App\Database\Seeds;

use CodeIgniter\CodeIgniter;
use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i=0;$i<15;$i++) {
            $name = $faker->name();
            $email = $faker->email();
            $hashedPassword = sha1(sha1(md5($email)));
            $data = [
                'name'      => $name,
                'password'  => $hashedPassword,
                'email'     => $email,
                'is_admin'  => 0,
                'photo'     => $name . '.jpg',
                'position'  => $faker->jobTitle()
            ];

            $this->db->table('employees')->insert($data);
        }
    }
}
