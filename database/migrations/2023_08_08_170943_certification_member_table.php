<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certification_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('certification_id')->constrained('certifications')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certification_member');
    }
};
