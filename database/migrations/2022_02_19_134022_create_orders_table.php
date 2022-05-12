<?php

declare(strict_types=1);

use App\Models\Offer;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('order_date');
            $table->integer('status')->default(0);
            $table->double('price');
            $table->string('comment')->nullable();
            $table->foreignIdFor(User::class, 'client_id');
            $table->foreignIdFor(User::class, 'freelancer_id');
            $table->foreignIdFor(Offer::class, 'service_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
