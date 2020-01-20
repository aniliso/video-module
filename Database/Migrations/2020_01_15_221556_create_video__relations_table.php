<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video__relations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('media_id')->unsigned();

            $table->integer('relation_id')->unsigned();
            $table->string('relation_type');

//            $table->index(['relation_type', 'relation_id']);

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
        Schema::dropIfExists('video__relations');
    }
}
