<?php

namespace Database\Seeders;

use App\Models\Presentacione;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresentacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presentacione::factory()->count(2)->create();
    }
}
