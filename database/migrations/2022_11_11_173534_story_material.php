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
        Schema::create('story_material', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code', 20);
            $table->string('type_material');
            $table->string('decor');
            $table->string('cell');
            $table->integer('length');
            $table->integer('width');
            $table->integer('thickness');
            $table->timestamps();
            $table->string('kronas_user', 20);
            $table->string('storage_code',20);
            $table->unsignedBigInteger('action_material_id');
            $table->tinyInteger('accounting');

            $table->foreign('action_material_id')
                ->references('id')
                ->on('action_material')
                ->onDelete('cascade');
        });
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
