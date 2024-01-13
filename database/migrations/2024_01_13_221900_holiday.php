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
        Schema::create("holiday", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("location_id");
            $table->string("title");
            $table->date("start_date");
            $table->integer("duration");
            $table->string("price");
            $table->integer("free_slots");

            $table->foreign("location_id")->references("id")->on("location")->onDelete("RESTRICT");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("holiday");
    }
};
