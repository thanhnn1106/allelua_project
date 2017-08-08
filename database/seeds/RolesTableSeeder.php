<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array(
                'role'        => ROLE_ADMIN,
                'description' => 'Administrator',
                'created_at'  => date('Y-m-d H:i:s'),
            ),
            array(
                'role'        => ROLE_SELLER,
                'description' => 'Seller',
                'created_at'  => date('Y-m-d H:i:s'),
            ),
            array(
                'role'        => ROLE_USER,
                'description' => 'User',
                'created_at'  => date('Y-m-d H:i:s'),
            )
        );
        foreach ($roles as $role) {
            $row = Roles::where('role', $role['role'])->first();
            if ($row === null) {
                DB::table('roles')->insert($role);
            }
        }
    }
}
