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
        Schema::create("locations", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("street");
            $table->string("number");
            $table->string("city");
            $table->string("country");
            $table->string("image_url");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("locations");
    }
};
