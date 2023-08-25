<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capability_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('capability_id');
            $table->boolean('base')->default(false);
            $table->boolean('portable')->default(false);

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('capability_id')->references('id')->on('capabilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capability_member');
    }
};
