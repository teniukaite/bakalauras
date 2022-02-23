<?php

use App\Models\Offer;
use App\Models\Review;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Offer::class, 'offer_id');
            $table->string('description');
            $table->float('price');
            $table->string('price_content');
            $table->integer('fk_service_id');
            $table->foreignIdFor(User::class, 'freelancer_id');
            $table->foreignIdFor(User::class, 'client_id');
            $table->foreignIdFor(Review::class, 'review_id');
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
        Schema::dropIfExists('projects');
    }
};
