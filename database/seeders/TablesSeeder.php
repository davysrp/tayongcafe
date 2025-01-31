<?php

namespace Database\Seeders;
use App\Models\Table;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TablesSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tables = [
            ['names' => 'Table 1', 'seats' => 4],
            ['names' => 'Table 2', 'seats' => 6],
            ['names' => 'Table 3', 'seats' => 8],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
