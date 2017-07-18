<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('price', 10, 0)->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('quantity_limit')->default(0);
            $table->tinyInteger('payment_method');
            $table->tinyInteger('shipping_method');
            $table->string('image_rand', 255)->nullable();
            $table->string('image_real', 255)->nullable();
            $table->string('position_use', 50)->nullable();
            $table->string('size', 255)->nullable();
            $table->string('style', 255)->nullable();
            $table->string('material', 255)->nullable();
            $table->bigInteger('view_number')->default(0)->comment('number view product');
            $table->tinyInteger('status')->comment('1=active, 0=inactive');
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
