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
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code',32);
            $table->unsignedBigInteger('type_material_id');
            $table->unsignedBigInteger('decor_id');
            $table->unsignedBigInteger('cell_id')->nullable();
            $table->integer('length');
            $table->integer('width');
            $table->integer('thickness');
            $table->timestamps();
            $table->string('storage_code', 20);
            $table->tinyInteger('accounting');

            /*  созадем связь   */
            $table->foreign('type_material_id')
                ->references('id')
                ->on('type_material')
                ->onDelete('cascade');

            $table->foreign('decor_id')
                ->references('id')
                ->on('decor')
                ->onDelete('cascade');

            $table->foreign('cell_id')
                ->references('id')
                ->on('cell')
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
