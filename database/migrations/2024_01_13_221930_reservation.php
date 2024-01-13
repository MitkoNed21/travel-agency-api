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
        Schema::create("reservations", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("holiday_id");
            $table->string("contact_name");
            $table->string("phone_number");

            $table->timestamps();
            
            $table->foreign("holiday_id")->references("id")->on("holidays")->onDelete("RESTRICT");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("reservations");
    }
};
