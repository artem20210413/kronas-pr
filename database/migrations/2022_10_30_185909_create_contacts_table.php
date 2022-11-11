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



        /*статика*/






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
