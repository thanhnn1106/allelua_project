<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = config('allelua.roles');
        $status = config('allelua.user_status.value.active');
        $users = [
            array(
                'company_name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '123456789',
                'role_id' => $role['administrator'],
                'country_id' => 1,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'company_name' => 'seller',
                'email' => 'seller@seller.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '123456789',
                'role_id' => $role['seller'],
                'country_id' => 2,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'full_name' => 'user',
                'email' => 'user@user.com',
                'password' => bcrypt('12345678'),
                'role_id' => $role['user'],
                'status' => $status,
                'sex' => config('allelua.sex.value.male'),
                'dob' => '1986-06-01',
                'created_at' => date('Y-m-d H:i:s'),
            ),
        ];

        foreach ($users as $user) {
            $chkUser = User::where('email', $user['email'])->first();
            if ($chkUser === NULL) {
                DB::table('users')->insert($user);
            }
        }
    }
}
