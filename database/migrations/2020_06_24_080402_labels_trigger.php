<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LabelsTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE FUNCTION tr_question_insert_fn() RETURNS TRIGGER AS $$
            DECLARE
                k int := 0;
                v record;
            BEGIN
                FOR v IN
                    SELECT * FROM jsonb_each_text(new.data->'labels')
                LOOP
                    INSERT INTO labels (uuid, question_uuid, user_id, label, position) values (v.key::uuid, NEW.uuid, new.user_id, v.value::text, k);
                    k := k + 1;
                END LOOP;
                RETURN NULL;
            END;
        $$ language plpgsql;
        CREATE trigger tr_question_insert AFTER INSERT ON questions FOR EACH ROW EXECUTE FUNCTION tr_question_insert_fn();");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION tr_question_insert_fn CASCADE');
    }
}
