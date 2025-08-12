<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            //categorias
            'ver-categoria',
            'crear-categoria',
            'editar-categoria',
            'eliminar-categoria',

            //clientes
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'eliminar-cliente',

            //Compra
            'ver-compra',
            'crear-compra',
            'mostrar-compra',
            'eliminar-compra',

            //laboratorio
            'ver-laboratorio',
            'crear-laboratorio',
            'editar-laboratorio',
            'eliminar-laboratorio',

            //Lote
            'ver-lote',
            'crear-lote',
            'editar-lote',
            'eliminar-lote',

            //marca
            'ver-marca',
            'crear-marca',
            'editar-marca',
            'eliminar-marca',

            //Presentacione
            'ver-presentacione',
            'crear-presentacione',
            'editar-presentacione',
            'eliminar-presentacione',

            //producto
            'ver-producto',
            'crear-producto',
            'mostrar-producto',
            'editar-producto',
            'eliminar-producto',

            //proveedore
            'ver-proveedore',
            'crear-proveedore',
            'editar-proveedore',
            'eliminar-proveedore',

            //sintoma
            'ver-sintoma',
            'crear-sintoma',
            'editar-sintoma',
            'eliminar-sintoma',

            //tipo
            'ver-tipo',
            'crear-tipo',
            'editar-tipo',
            'eliminar-tipo',

            //Venta
            'ver-venta',
            'crear-venta',
            'mostrar-venta',
            'eliminar-venta',

             //Roles
             'ver-role',
             'crear-role',
             'editar-role',
             'eliminar-role',

            //User
            'ver-user',
            'crear-user',
            'editar-user',
            'eliminar-user',

            //Perfil 
            'ver-perfil',
            'editar-perfil'
        ];

        foreach($permisos as $permiso){
            ModelsPermission::create(['name' => $permiso]);
        }
    }
}
