<?php

declare(strict_types=1);

use App\Models\Conflict;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConflictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conflicts', function (Blueprint $table) {
            $table->id();
            $table->string('identification');
            $table->longText('explanation');
            $table->string('cause');
            $table->integer('status')->default(0);
            $table->string('decision')->nullable();
            $table->foreignIdFor(Conflict::class, 'parent_id')->nullable();
            $table->foreignIdFor(User::class, 'plaintiff_id');
            $table->foreignIdFor(Order::class, 'order_id');
            $table->foreignIdFor(User::class, 'moderator_id')->nullable();
            $table->dateTime('resolved_at')->nullable();
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
        Schema::dropIfExists('conflicts');
    }
}
