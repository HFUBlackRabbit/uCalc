<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('uuid')->default(new Expression('uuid_generate_v4()'))->primary();
            $table->unsignedBigInteger('user_id');
            $table->timestampTz('created_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE questions ADD COLUMN data JSONB
            CHECK(
                data::jsonb->\'title\' IS NOT NULL
                AND data::jsonb->\'label_ids\' IS NOT NULL
                AND data::jsonb->\'labels\' IS NOT NULL)
            ');
        DB::statement('ALTER TABLE questions ADD COLUMN title VARCHAR(255) GENERATED ALWAYS AS (regexp_replace(data->>\'title\', \'<[^>]*>\', \'\', \'g\')) STORED');
        DB::statement('ALTER TABLE questions ADD COLUMN hash VARCHAR(255) GENERATED ALWAYS AS (MD5(data::text)) STORED');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
