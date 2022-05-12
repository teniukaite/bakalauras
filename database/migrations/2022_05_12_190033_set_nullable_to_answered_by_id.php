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
        Schema::table('requests', function (Blueprint $table) {
            $table->dropColumn('answeredBy_id');
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->unsignedBigInteger('answeredBy_id')->nullable();
            $table->foreign('answeredBy_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['answeredBy_id']);
            $table->dropColumn('answeredBy_id');
        });

        Schema::table('requests', function (Blueprint $table) {
            $table->unsignedBigInteger('answeredBy_id');
            $table->foreign('answeredBy_id')->references('id')->on('users');
        });
    }
};
