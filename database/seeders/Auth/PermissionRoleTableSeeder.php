<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder {
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run() {
        Schema::disableForeignKeyConstraints();
        //Artisan::call('cache:clear');

        // Create Roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        //Generate Permission aka Akses Menu
        $permission1 = Permission::firstOrCreate(['name' => 'view_alat_lab']);
        $permission2 = Permission::firstOrCreate(['name' => 'view_bahan_lab']);
        $permission3 = Permission::firstOrCreate(['name' => 'add_pengembalian_lab']);

        //contains user CRUD permission (only for admin ?)
        $permissions = Permission::defaultPermissions();
        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        //generate alat lab CRUD permission
        Artisan::call('auth:permission', [
            'name' => 'alat_lab',
        ]);
        echo "\n _Alat_ Permissions Created.";

        //generate bahan lab CRUD permission
        Artisan::call('auth:permission', [
            'name' => 'bahan_lab',
        ]);
        echo "\n _Bahan_ Permissions Created.";

        //generate pengembalian lab CRUD permission
        Artisan::call('auth:permission', [
            'name' => 'pengembalian_lab',
        ]);
        echo "\n _Pengembalian_ Permissions Created.";

        echo "\n\n";

        // Assign Permissions to Roles
        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo([
            $permission1,
            $permission2,
            $permission3,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
