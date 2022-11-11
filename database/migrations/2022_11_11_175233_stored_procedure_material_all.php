<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `material_all`;
            CREATE PROCEDURE `material_all` ()
            BEGIN
            SELECT m.* , d.decor_name, tm.tm_name, c.rack, c.storey, c.row
            FROM material m
            INNER JOIN decor d ON m.decor_id = d.id
            INNER JOIN type_material tm ON m.type_material_id = tm.id
            INNER JOIN cell c ON m.cell_id = c.id;
            END";
        \DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
