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
        Schema::create('masterclasses', function (Blueprint $table) {
            $table->id();
            $table->json('img_main');
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->boolean('age_restriction')->default(0);
            $table->integer('status')->default(0);
            $table->integer('lector_id');
            $table->text('decline_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterclasses');
    }
};
