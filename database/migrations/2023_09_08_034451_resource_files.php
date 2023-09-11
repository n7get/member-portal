<?php

use App\Models\resources\File;
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
            $table->foreignId('user_id')->constrained();
            $table->string('name')->unique();   
            $table->string('file_name')->unique();
            $table->string('description');
            $table->string('version');
            $table->string('mime_type');
            $table->enum('access', File::$ACCESS_LEVELS);
            // $table->binary('data');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE resources_files ADD data MEDIUMBLOB AFTER access");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_files');
    }
};
