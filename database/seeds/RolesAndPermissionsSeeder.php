<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles 
        $roles = ['requestor', 'approver', 'admin'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Create permissions
        $permissions = [
            'View All Requests',
            'View Own Requests For Approval',
            'View Own Approved Requests',
            'Create Own Requests',
            'Edit Own Requests for approval',
            'Approve Request',
            'Reject Requests',
            'Enroll new users',
            'Update global account subscription charges',
            'Set user roles',
            'Update user details',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        Role::findByName('admin')->givePermissionTo([
            'View All Requests',
            'View Own Requests For Approval',
            'View Own Approved Requests',
            'Create Own Requests',
            'Edit Own Requests for approval',
            'Enroll new users',
            'Update global account subscription charges',
            'Set user roles',
            'Update user details',
        ]);

        Role::findByName('approver')->givePermissionTo([
            'View All Requests',
            'View Own Requests For Approval',
            'View Own Approved Requests',
            'Create Own Requests',
            'Edit Own Requests for approval',
            'Approve Request',
            'Reject Requests',
        ]);

        Role::findByName('requestor')->givePermissionTo([
            'View All Requests',
            'View Own Requests For Approval',
            'View Own Approved Requests',
            'Create Own Requests',
            'Edit Own Requests for approval',
        ]);
    }
}
