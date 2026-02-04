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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('owner_name')->nullable();
            $table->string('owner_phone')->nullable();
            $table->text('owner_description')->nullable();
            $table->string('owner_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('owner_name');
            $table->dropColumn('owner_phone');
            $table->dropColumn('owner_description');
            $table->dropColumn('owner_address');
        });
    }
};
