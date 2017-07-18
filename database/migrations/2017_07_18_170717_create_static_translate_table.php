<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statics_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('static_id')->unsigned();
            $table->foreign('static_id')->references('id')->on('statics')->onDelete('cascade')->onUpdate('cascade');
            $table->char('language_code', 2);
            $table->foreign('language_code')->references('iso2')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->longText('content')->nullable();
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
        Schema::drop('statics_translate');
    }
}
