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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->enum('status', ['CANCELED', 'COMPLETED', 'ONGOING'])->default('ONGOING');

            $table->foreignId('passenger_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('route_id')->nullable()->constrained('routes')->nullOnDelete();
            $table->foreignId('pickup_point_id')->constrained('stops')->cascadeOnDelete();
            $table->foreignId('dropoff_point_id')->constrained('stops')->cascadeOnDelete();
            $table->foreignId('bus_id')->nullable()->constrained('buses')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
