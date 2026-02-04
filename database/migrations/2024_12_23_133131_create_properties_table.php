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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->constrained()->onDelete('set null');
            $table->string('offer_type');
            $table->integer('price');
            $table->integer('area');
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->boolean('is_available')->default(true);
            $table->boolean('in_home')->default(0);
            $table->unsignedBigInteger('view_count')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });

        Schema::create('property_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
            $table->text('detailed_description')->nullable();
            $table->string('address');
            $table->string('floor')->nullable();
            $table->string('furnishing');
            $table->string('finishing');
            $table->timestamps();

            $table->unique(['property_id', 'locale']);
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
        Schema::dropIfExists('property_translations');
    }
};
