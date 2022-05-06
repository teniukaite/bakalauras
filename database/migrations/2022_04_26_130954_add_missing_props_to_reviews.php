<?php

declare(strict_types=1);

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('text');
            $table->string('rating');
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->foreignIdFor(Offer::class, 'offer_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('offer_id');
            $table->dropColumn('text');
            $table->dropColumn('rating');
        });
    }
};
