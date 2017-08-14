<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Order;
use App\OrderItem;

class OrderDataTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Giường',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Nệm',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Tủ',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_name' => 'Ghế',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Bồn cầu',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Cửa',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Giường',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Gối',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Chăn',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Đèn',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Vòi',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('order_items')->insert([
            'order_id' => 5,
            'seller_id' => 2,
            'product_id' => 1,
            'product_name' => 'Bồn',
            'price' => 100,
            'quantity' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
