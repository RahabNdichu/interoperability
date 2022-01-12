<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'position_create',
            ],
            [
                'id'    => 18,
                'title' => 'position_edit',
            ],
            [
                'id'    => 19,
                'title' => 'position_show',
            ],
            [
                'id'    => 20,
                'title' => 'position_delete',
            ],
            [
                'id'    => 21,
                'title' => 'position_access',
            ],
            [
                'id'    => 22,
                'title' => 'advance_create',
            ],
            [
                'id'    => 23,
                'title' => 'advance_edit',
            ],
            [
                'id'    => 24,
                'title' => 'advance_show',
            ],
            [
                'id'    => 25,
                'title' => 'advance_delete',
            ],
            [
                'id'    => 26,
                'title' => 'advance_access',
            ],
            [
                'id'    => 27,
                'title' => 'student_create',
            ],
            [
                'id'    => 28,
                'title' => 'student_edit',
            ],
            [
                'id'    => 29,
                'title' => 'student_show',
            ],
            [
                'id'    => 30,
                'title' => 'student_delete',
            ],
            [
                'id'    => 31,
                'title' => 'student_access',
            ],
            [
                'id'    => 32,
                'title' => 'payroll_management_access',
            ],
            [
                'id'    => 33,
                'title' => 'record_create',
            ],
            [
                'id'    => 34,
                'title' => 'record_edit',
            ],
            [
                'id'    => 35,
                'title' => 'record_show',
            ],
            [
                'id'    => 36,
                'title' => 'record_delete',
            ],
            [
                'id'    => 37,
                'title' => 'record_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
