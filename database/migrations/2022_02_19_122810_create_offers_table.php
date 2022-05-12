<?php

declare(strict_types=1);

use App\Models\Category;
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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->text('description');
            $table->double('price');
            $table->foreignIdFor(User::class, 'freelancer_id');
            $table->foreignIdFor(Category::class, 'category_id');
            $table->integer('city');
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
        Schema::dropIfExists('offers');
    }
};
