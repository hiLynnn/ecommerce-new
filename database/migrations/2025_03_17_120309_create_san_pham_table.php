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
        Schema::create('san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('danh_muc_id')->constrained('danh_muc')->onDelete('cascade');
            $table->string('ten_san_pham');
            $table->string('slug')->unique();
            $table->text('mo_ta')->nullable();
            $table->decimal('gia', 12, 2);
            $table->integer('so_luong')->default(0);
            $table->string('anh_dai_dien');
            $table->boolean('noi_bat')->default(false);
            $table->boolean('hien_thi')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};
