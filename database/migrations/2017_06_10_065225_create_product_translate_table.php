<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade')->onUpdate('cascade');
            $table->char('language_code', 2);
            $table->foreign('language_code')->references('iso2')->on('languages')->onDelete('cascade')->onUpdate('cascade')->onUpdate('cascade');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('color', 255)->nullable();
            $table->string('brand', 255);
            $table->string('info_tech', 255)->nullable();
            $table->string('feature_highlight', 255)->nullable();
            $table->string('source', 255);
            $table->string('guarantee', 255)->nullable();
            $table->string('delivery_location', 255);
            $table->mediumText('detail')->nullable();
            $table->mediumText('form_product')->nullable();
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
        Schema::drop('product_translate');
    }
}
