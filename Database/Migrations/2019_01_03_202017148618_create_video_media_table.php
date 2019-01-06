<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video__media', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->string('url');
            $table->integer('sorting')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->json('embed')->nullable();

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('video__categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('video__media');
        Schema::enableForeignKeyConstraints();
    }
}
