<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->uuid('uuid')->default(new Expression('uuid_generate_v4()'));
            $table->uuid('question_uuid');
            $table->unsignedBigInteger('user_id');
            $table->string('label');
            $table->integer('position');

            $table->primary(['uuid', 'user_id', 'question_uuid']);

            $table->foreign('question_uuid')->references('uuid')->on('questions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels');
    }
}
