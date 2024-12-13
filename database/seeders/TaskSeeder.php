<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $tasks = [
            [
                'client_id' => 1,
                'device' => 'Celular',
                'brand' => 'Apple',
                'model' => '14',
                'serial_number' => null,
                'description' => 'Tela do celular nao liga',
                'price' => 192.00,
                'status' => 0
            ],
            [
                'client_id' => 1,
                'device' => 'Notebook',
                'brand' => 'Dell',
                'model' => 'Inspiron 15',
                'serial_number' => 'A1B2C3D4E5',
                'description' => 'Teclado com falha em algumas teclas',
                'price' => 450.00,
                'status' => 1
            ],
            [
                'client_id' => 1,
                'device' => 'Tablet',
                'brand' => 'Samsung',
                'model' => 'Galaxy Tab S7',
                'serial_number' => 'S7G9T3Q4W5',
                'description' => 'Bateria descarrega rapidamente',
                'price' => 300.00,
                'status' => 0
            ],
            [
                'client_id' => 1,
                'device' => 'Celular',
                'brand' => 'Xiaomi',
                'model' => 'Redmi Note 10',
                'serial_number' => 'X5R7N3V2',
                'description' => 'Tela trincada',
                'price' => 150.00,
                'status' => 0
            ],
            [
                'client_id' => 2,
                'device' => 'Console',
                'brand' => 'Sony',
                'model' => 'PlayStation 5',
                'serial_number' => 'PS5XJH32',
                'description' => 'Não lê discos',
                'price' => 650.00,
                'status' => 1
            ],
            [
                'client_id' => 3,
                'device' => 'Celular',
                'brand' => 'Motorola',
                'model' => 'Moto G Power',
                'serial_number' => null,
                'description' => 'Problema no alto-falante',
                'price' => 120.00,
                'status' => 0
            ],
            [
                'client_id' => 4,
                'device' => 'Tablet',
                'brand' => 'Apple',
                'model' => 'iPad Pro',
                'serial_number' => 'IPAD2020',
                'description' => 'Tela com manchas',
                'price' => 500.00,
                'status' => 1
            ],
            [
                'client_id' => 4,
                'device' => 'Notebook',
                'brand' => 'HP',
                'model' => 'Pavilion 14',
                'serial_number' => 'HPN14Q56',
                'description' => 'Lento para iniciar',
                'price' => 320.00,
                'status' => 1
            ],
            [
                'client_id' => 4,
                'device' => 'Celular',
                'brand' => 'Samsung',
                'model' => 'Galaxy S21',
                'serial_number' => null,
                'description' => 'Câmera traseira com defeito',
                'price' => 270.00,
                'status' => 0
            ],
            [
                'client_id' => 6,
                'device' => 'Console',
                'brand' => 'Microsoft',
                'model' => 'Xbox Series X',
                'serial_number' => 'XBOX2021X',
                'description' => 'Superaquecimento',
                'price' => 580.00,
                'status' => 1
            ],
            [
                'client_id' => 6,
                'device' => 'Celular',
                'brand' => 'OnePlus',
                'model' => '9 Pro',
                'serial_number' => 'OP9PRO1234',
                'description' => 'Falha ao carregar',
                'price' => 210.00,
                'status' => 1
            ],
            [
                'client_id' => 6,
                'device' => 'Notebook',
                'brand' => 'Asus',
                'model' => 'ZenBook 14',
                'serial_number' => 'ASZB142021',
                'description' => 'A tela pisca intermitentemente',
                'price' => 390.00,
                'status' => 0
            ],
            [
                'client_id' => 7,
                'device' => 'Tablet',
                'brand' => 'Huawei',
                'model' => 'MatePad Pro',
                'serial_number' => 'HWMATE2022',
                'description' => 'Conector de fone de ouvido com defeito',
                'price' => 135.00,
                'status' => 0
            ],
            [
                'client_id' => 7,
                'device' => 'Celular',
                'brand' => 'Google',
                'model' => 'Pixel 6',
                'serial_number' => 'GPIXL62022',
                'description' => 'Sensor de impressão digital não responde',
                'price' => 250.00,
                'status' => 0
            ],
            [
                'client_id' => 8,
                'device' => 'Console',
                'brand' => 'Nintendo',
                'model' => 'Switch',
                'serial_number' => 'NSWITCH2021',
                'description' => 'Problema no controle Joy-Con',
                'price' => 110.00,
                'status' => 1
            ]
        ];
        

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
