<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('draws', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('drawNumber');
            $table->date('drawDate');
            $table->string('pdfPath');
            $table->timestamps();
        });

        // Enforce 7-digit constraint (e.g., values between 1,000,000 and 9,999,999)
        // DB::statement('ALTER TABLE draws ADD CONSTRAINT draw_number_range_check CHECK ("drawNumber" >= 1000000 AND "drawNumber" <= 9999999)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draws');
    }
};
