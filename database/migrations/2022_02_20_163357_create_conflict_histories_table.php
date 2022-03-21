<?php

use App\Models\Conflict;
use App\Models\User;
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
        Schema::create('conflict_histories', function (Blueprint $table) {
            $table->id();
            $table->string('details');
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Conflict::class, 'conflict_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conflict_histories');
    }
};
