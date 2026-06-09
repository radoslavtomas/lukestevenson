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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('page_title');
            $table->string('page_subtitle');
            $table->text('page_description');
            $table->text('page_keywords');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('address_line3');
            $table->string('postcode');
            $table->string('phone');
            $table->string('email');
            $table->text('map');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
