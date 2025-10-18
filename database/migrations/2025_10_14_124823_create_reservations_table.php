<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->ondelete('cascade');
//            `$table->foreignId('consulter_id')->constrained()->ondelete('cascade')->nullable();`
            $table->unsignedBigInteger('consulter_id')->nullable();
            $table->date('date');
            $table->time('time');
            $table->timestamps();


//            $table->foreign('consulter_id')->references('id')->on('consulters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
