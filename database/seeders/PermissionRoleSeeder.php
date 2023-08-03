<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManagementAccess\Role;
use App\Models\ManagementAccess\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $permissions = Permission::all();
        $admin_permissions = $permissions->filter(function ($permission) {
            return substr($permission->name, 0, 19) != 'laporan_dosen_table' && substr($permission->name, 0, 19) != 'laporan_kajur_table' && substr($permission->name, 0, 19) != 'laporan_wadir_table';
        });
        Role::findOrFail(1)->permission()->sync($admin_permissions);
        
        // Wadir
        $wadir_permissions = $permissions->filter(function ($permission) {
            return substr($permission->name, 0, 11) != 'management_' && substr($permission->name, 0, 12) != 'master_data_' && substr($permission->name, 0, 6) != 'dosen_' && substr($permission->name, 0, 10) != 'mahasiswa_' && substr($permission->name, 0, 14) != 'laporan_create' && substr($permission->name, 0, 13) != 'laporan_table' && substr($permission->name, 0, 19) != 'laporan_kajur_table' && substr($permission->name, 0, 19) != 'laporan_dosen_table' && substr($permission->name, 0, 14) != 'dashboard_user' && substr($permission->name, 0, 15) != 'dashboard_dosen' && substr($permission->name, 0, 19) != 'dashboard_mahasiswa' && substr($permission->name, 0, 14) != 'dashboard_chat' && substr($permission->name, 0, 5) != 'chat_';
        });
        Role::findOrFail(2)->permission()->sync($wadir_permissions);

        // Kajur
        $kajur_permissions = $permissions->filter(function ($permission) {
            return substr($permission->name, 0, 11) != 'management_' && substr($permission->name, 0, 12) != 'master_data_' && substr($permission->name, 0, 6) != 'dosen_' && substr($permission->name, 0, 10) != 'mahasiswa_' && substr($permission->name, 0, 14) != 'laporan_create' && substr($permission->name, 0, 13) != 'laporan_table' && substr($permission->name, 0, 19) != 'laporan_wadir_table' && substr($permission->name, 0, 19) != 'laporan_dosen_table' && substr($permission->name, 0, 14) != 'dashboard_user' && substr($permission->name, 0, 15) != 'dashboard_dosen' && substr($permission->name, 0, 19) != 'dashboard_mahasiswa' && substr($permission->name, 0, 14) != 'dashboard_chat' && substr($permission->name, 0, 5) != 'chat_' && substr($permission->name, 0, 20) != 'laporan_edit_kaprodi';
        });
        Role::findOrFail(3)->permission()->sync($kajur_permissions);

        // Kaprodi
        $kaprodi_permissions = $permissions->filter(function ($permission) {
            return substr($permission->name, 0, 11) != 'management_' && substr($permission->name, 0, 12) != 'master_data_' && substr($permission->name, 0, 6) != 'dosen_' && substr($permission->name, 0, 10) != 'mahasiswa_' && substr($permission->name, 0, 14) != 'laporan_create' && substr($permission->name, 0, 13) != 'laporan_table' && substr($permission->name, 0, 19) != 'laporan_wadir_table' && substr($permission->name, 0, 19) != 'laporan_dosen_table' && substr($permission->name, 0, 14) != 'dashboard_user' && substr($permission->name, 0, 15) != 'dashboard_dosen' && substr($permission->name, 0, 19) != 'dashboard_mahasiswa' && substr($permission->name, 0, 14) != 'dashboard_chat' && substr($permission->name, 0, 5) != 'chat_' && substr($permission->name, 0, 18) != 'laporan_edit_kajur';
        });
        Role::findOrFail(4)->permission()->sync($kaprodi_permissions);

        // Dosen
        $dosen_permissions = $permissions->filter(function ($permission) {
            return substr($permission->name, 0, 11) != 'management_' && substr($permission->name, 0, 12) != 'master_data_' && substr($permission->name, 0, 6) != 'dosen_' && substr($permission->name, 0, 10) != 'mahasiswa_' && substr($permission->name, 0, 13) != 'laporan_table' && substr($permission->name, 0, 19) != 'laporan_kajur_table' && substr($permission->name, 0, 19) != 'laporan_wadir_table' && substr($permission->name, 0, 14) != 'dashboard_user' && substr($permission->name, 0, 15) != 'dashboard_dosen' && substr($permission->name, 0, 19) != 'dashboard_mahasiswa' && substr($permission->name, 0, 11) != 'chat_delete' && substr($permission->name, 0, 10) != 'chat_pesan';
        });
        Role::findOrFail(5)->permission()->sync($dosen_permissions);

        // Mahasiswa
        $mahasiswa_permissions = $permissions->filter(function ($permission) {
            return substr($permission->name, 0, 11) != 'management_' && substr($permission->name, 0, 12) != 'master_data_' && substr($permission->name, 0, 6) != 'dosen_' && substr($permission->name, 0, 10) != 'mahasiswa_' && substr($permission->name, 0, 8) != 'laporan_' && substr($permission->name, 0, 14) != 'dashboard_user' && substr($permission->name, 0, 15) != 'dashboard_dosen' && substr($permission->name, 0, 19) != 'dashboard_mahasiswa' && substr($permission->name, 0, 17) != 'dashboard_laporan' && substr($permission->name, 0, 11) != 'chat_edit' && substr($permission->name, 0, 11) != 'chat_delete' && substr($permission->name, 0, 12) != 'chat_balasan';
        });
        Role::findOrFail(6)->permission()->sync($mahasiswa_permissions);
    }
}
