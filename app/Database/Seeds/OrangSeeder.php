<?php

namespace App\Database\Seeds;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
    //     $data = [
    //         [
    //         'nama' => 'Bejo',
    //         'alamat'    => 'Jalan Seroja Cibubur Ciracas',
    //         'created_at' => Time::now(),
    //         'updated_at' => Time::now()
    //         ],
    //         [
    //             'nama' => 'Paijo',
    //             'alamat'    => 'Jalan Seroja Cibubur Ciracas',
    //             'created_at' => Time::now(),
    //             'updated_at' => Time::now()
    //         ],
    //         [
    //             'nama' => 'Widya',
    //             'alamat'    => 'Jalan Seroja Cibubur Ciracas',
    //             'created_at' => Time::now(),
    //             'updated_at' => Time::now()
    //         ]
    // ];

        // Simple Queries
        // $this->db->query("INSERT INTO Orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        
        $faker = \Faker\Factory::create('id_ID');
        for($i=0; $i<1000;$i++){
        $data = [
            'nama' => $faker->name(),
            'alamat'    => $faker->address,
            'created_at' => Time::createFromTimestamp($faker->unixTime()),
            'updated_at' => Time::now()
    ];
    $this->db->table('Orang')->insert($data);
}
        // $this->db->table('Orang')->insertBatch($data);
    }
}