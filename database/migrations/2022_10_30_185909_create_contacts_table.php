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
        Schema::create('cell', function (Blueprint $table) {
            $table->id();
            $table->string('rack');
            $table->integer('storey');
            $table->integer('row');
            //$table->timestamps();
        });
        Schema::create('decor', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
