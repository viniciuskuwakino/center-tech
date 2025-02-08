<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $phoneNumber = rand(11, 99) . rand(90000, 99999) . rand(1000, 9999);

        $clients = [
            [
                'name' => 'Artur Prata',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Lucas Shinozaki',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Leonardo Giazzi',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Matheus Ruan Teodoro',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Carlos Parminondi',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Giovana Kuwakino',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Pedro Torz',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Michael Souza',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Kadmiel Kleb',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Jessica Mendes',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Anderson Antunes',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Fabio Junior',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Clarencio Desz',
                'phone' => $phoneNumber++
            ],
            [
                'name' => 'Jhonathan Cunha',
                'phone' => $phoneNumber++
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }

    }
}
