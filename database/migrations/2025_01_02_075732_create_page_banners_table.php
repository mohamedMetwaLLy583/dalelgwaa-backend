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
        Schema::create('page_banners', function (Blueprint $table) {
            $table->id();
            $table->string('about_us_title_ar')->nullable();
            $table->string('about_us_title_en')->nullable();
            $table->text('about_us_desc_ar')->nullable();
            $table->text('about_us_desc_en')->nullable();
            $table->string('contact_us_title_ar')->nullable();
            $table->string('contact_us_title_en')->nullable();
            $table->text('contact_us_desc_ar')->nullable();
            $table->text('contact_us_desc_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_banners');
    }
};
