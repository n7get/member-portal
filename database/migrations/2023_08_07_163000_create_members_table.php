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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique('member_user_id');
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('mailing_address_street', 100)->nullable();
            $table->string('mailing_address_city', 100)->nullable();
            $table->string('mailing_address_state', 2)->nullable();
            $table->string('mailing_address_zip', 10)->nullable();
            $table->boolean('part_year_nv_resident')->default(false);
            $table->string('callsign', 7)->unique('callsign_index');
            $table->date('expiration');
            $table->string('shares_callsign', 10)->nullable();
            $table->string('gmrs_callsign', 10)->nullable();
            $table->string('cellPhone', 20);
            $table->string('cell_sms_carrier', 20);
            $table->boolean('winlink_account')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
