<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "Salary",
            "Other Income",
            "Family Expense",
            "Transport Expense",
            "Meal Expense",
        ];

        foreach ($data as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
    }
}
