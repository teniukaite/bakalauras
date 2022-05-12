<?php

declare(strict_types=1);

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignIdFor(City::class, 'city')->change();
        });
    }

    public function down()
    {
    }
};
