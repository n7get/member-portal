<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('members_member_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('certification_id')->constrained('member_certifications')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members_member_certifications');
    }
};
