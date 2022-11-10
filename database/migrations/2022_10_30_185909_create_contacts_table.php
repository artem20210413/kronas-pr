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
        Schema::create('type_material', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //$table->timestamps();
        });
        /*статика*/
        Schema::create('action_user', function (Blueprint $table) {
            $table->id();
            $table->string('action_u');
            //$table->timestamps();
        });
        Schema::create('action_material', function (Blueprint $table) {
            $table->id();
            $table->string('action_m');
            //$table->timestamps();
        });
        Schema::create('story_material', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code', 32);
            $table->string('type_material');
            $table->string('decor');
            $table->string('cell');
            $table->integer('length');
            $table->integer('width');
            $table->integer('thickness');
            $table->timestamps();
            $table->unsignedBigInteger('kronas_user');
            $table->unsignedBigInteger('action_material_id');
            $table->tinyInteger('accounting', 2);//- 2

            $table->foreign('action_material_id')
                ->references('id')
                ->on('action_material')
                ->onDelete('cascade');
        });

        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code',32);
            $table->unsignedBigInteger('type_material_id');
            $table->unsignedBigInteger('decor_id');
            $table->unsignedBigInteger('cell_id');
            $table->integer('length');
            $table->integer('width');
            $table->integer('thickness');
            $table->timestamps();
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
    //
   /* public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('referrer_id');
            $table->unsignedBigInteger('referral_id')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->string('code', 100)->unique();
            $table->timestamps();

            $table->foreign('referrer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('referral_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');

            $table->unique(['referrer_id', 'referral_id', 'role_id']);
        });
    }*/
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
