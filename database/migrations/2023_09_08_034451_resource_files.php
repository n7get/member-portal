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
        Schema::create('resources_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('mime_type');
            $table->enum('type', ['public', 'member', 'leadership']);
            $table->longText('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_files');
    }
};
