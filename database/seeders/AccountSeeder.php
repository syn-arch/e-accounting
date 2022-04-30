<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                "name" => "Gaji Karyawan",
                "id_category" => 1
            ],
            [
                "name" => "Gaji Ketua MPR",
                "id_category" => 1
            ],
            [
                "name" => "Profit Trading",
                "id_category" => 2
            ],
            [
                "name" => "Biaya Sekolah",
                "id_category" => 3
            ],
            [
                "name" => "Bensin",
                "id_category" => 4
            ],
            [
                "name" => "Parkir",
                "id_category" => 4
            ],
            [
                "name" => "Makan Siang",
                "id_category" => 5
            ],
            [
                "name" => "Makana Pokok Bulanan",
                "id_category" => 5
            ],
        ];

        foreach ($accounts as $account) {
            Account::create([
                'name' => $account['name'],
                'id_category' => $account['id_category'],
            ]);
        }
    }
}
