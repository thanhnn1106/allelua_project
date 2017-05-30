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
        $users = [
            array(
                'company_name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '123456789',
                'role_id' => 1,
                'country_id' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'company_name' => 'seller',
                'email' => 'seller@seller.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '123456789',
                'role_id' => 2,
                'country_id' => 2,
                'status' => 1,
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
