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
        Schema::create("holidays", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("location_id");
            $table->string("title");
            $table->date("start_date");
            $table->integer("duration");
            $table->unsignedDecimal("price", 8, 2);
            $table->integer("free_slots");

            $table->timestamps();

            $table->foreign("location_id")->references("id")->on("locations")->onDelete("RESTRICT");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("holidays");
    }
};
