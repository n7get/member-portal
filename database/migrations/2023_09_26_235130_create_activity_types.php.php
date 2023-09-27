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
        Schema::create('activity_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('activity_modes', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->datetime('date');
            $table->integer('duration');
            $table->string('location');
            $table->string('notes')->nullable();
            $table->foreignId('activity_type_id')->constrained();
            $table->timestamps();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade');
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('activity_mode_id')->nullable()->constrained('activity_modes')->onDelete('cascade');
            $table->boolean('attended')->default(false);
            $table->integer('duration')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_types');
        Schema::dropIfExists('activity_modes');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('activity_logs');
    }
};
