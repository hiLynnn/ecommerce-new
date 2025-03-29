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
        Schema::create('khuyen_mai', function (Blueprint $table) {
            $table->id();
            $table->string('promotions_name');
            $table->integer('promotions_times');
            $table->string('promotions_code')->unique();
            $table->integer('promotions_condition'); // 1: %, 2: tiền
            $table->integer('promotions_number');
            $table->date('promotionsdate_start');
            $table->date('promotionsdate_end');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khuyen_mai');
    }
};
