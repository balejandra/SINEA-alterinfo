<?php

namespace Database\Seeders;


use App\Models\Publico\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class BusquedaPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            //Permisos para busquedas
            'show-busqueda',
            'estadia-busqueda',
            'zarpesN-busqueda',
            'zarpesI-busqueda'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }

        $roles = [
            [
                'id' => 12,
                'name' => 'Supervisor Zarpes',
                'guard_name' => 'web',
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'name' => 'Consulta Zarpes Simple',
                'guard_name' => 'web',
                'created_at' => now(),],
            [
                'id' => 14,
                'name' => 'Consulta Zarpes',
                'guard_name' => 'web',
                'created_at' => now(),],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
        $superadmin_permissions=Permission::all();
        Role::findOrFail(1)->permissions()->sync($superadmin_permissions->pluck('id'));

        //Supervisor Zarpes
        $supervisor_zarpes=Permission::whereIn('name', [
            'show-busqueda',
            'estadia-busqueda',
            'zarpesN-busqueda',
            'zarpesI-busqueda'

        ])->get();
        Role::findOrFail(12)->permissions()->sync($supervisor_zarpes->pluck('id'));

        //Consulta Zarpes Simple
        $consulta_zarpes_simple=Permission::whereIn('name', [
            'show-busqueda',
            'zarpesN-busqueda',
            'zarpesI-busqueda'

        ])->get();
        Role::findOrFail(13)->permissions()->sync($consulta_zarpes_simple->pluck('id'));


        //Consulta Zarpes
        $consulta_zarpes=Permission::whereIn('name', [
            'show-busqueda',
            'estadia-busqueda',
            'zarpesN-busqueda',
            'zarpesI-busqueda'

        ])->get();
        Role::findOrFail(14)->permissions()->sync($consulta_zarpes->pluck('id'));

        $menuPermisos=Menu::where('name','Permisos de Zarpes y Estadía')->first()->id;
        $busquedaPermisos = Menu::create([
            'name' => 'Busqueda',
            'url' => '/busquedaPermisos',
            'order' => '3',
            'parent' => $menuPermisos,
            'icono'=>'fas fa-search-plus',
        ]);

        $menuRols = [
            array('role_id' => '1', 'menu_id' => $menuPermisos),
            array('role_id' => '12', 'menu_id' => $menuPermisos),
            array('role_id' => '13', 'menu_id' => $menuPermisos),
            array('role_id' => '14', 'menu_id' => $menuPermisos),

            array('role_id' => '1', 'menu_id' => $busquedaPermisos['id']),
            array('role_id' => '12', 'menu_id' => $busquedaPermisos['id']),
            array('role_id' => '13', 'menu_id' => $busquedaPermisos['id']),
            array('role_id' => '14', 'menu_id' => $busquedaPermisos['id']),

        ];
        DB::table('menus_roles')->insert($menuRols);
    }

}
