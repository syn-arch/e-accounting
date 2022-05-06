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
                'account_number' => '001',
                "id_category" => 1
            ],
            [
                "name" => "Gaji Ketua MPR",
                'account_number'
                => '002',
                "id_category" => 1
            ],
            [
                "name" => "Profit Trading",
                'account_number'
                => '003',
                "id_category" => 2
            ],
            [
                "name" => "Biaya Sekolah",
                'account_number'
                => '004',
                "id_category" => 3
            ],
            [
                "name" => "Bensin",
                'account_number'
                => '005',
                "id_category" => 4
            ],
            [
                "name" => "Parkir",
                'account_number'
                => '006',
                "id_category" => 4
            ],
            [
                "name" => "Makan Siang",
                'account_number'
                => '007',
                "id_category" => 5
            ],
            [
                "name" => "Makana Pokok Bulanan",
                'account_number'
                => '008',
                "id_category" => 5
            ],
        ];

        foreach ($accounts as $account) {
            Account::create([
                'name' => $account['name'],
                'account_number' => $account['account_number'],
                'id_category' => $account['id_category'],
            ]);
        }
    }
}
