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
        Schema::create('member_others', function (Blueprint $table) {
            $table->id();
            $table->string('description', 255);
            $table->boolean('needs_extra_info')->default(false);
            $table->string('prompt')->nullable();
            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_others');
    }
};
