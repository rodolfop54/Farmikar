<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        /* \App\Models\User::factory()->create([
            'name' => 'Rodolfo Parra',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678')
        ]); */

        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(LaboratorioSeeder::class);
        $this->call(PresentacioneSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(DocumentoSeeder::class);
        $this->call(ComprobanteSeeder::class);
        $this->call(SintomaSeeder::class);
    }
}
