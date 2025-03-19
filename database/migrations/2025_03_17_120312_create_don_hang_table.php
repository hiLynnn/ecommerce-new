<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoi_dung_id')->constrained('nguoi_dung')->onDelete('cascade');
            $table->decimal('tong_tien', 12, 2);
            $table->enum('trang_thai', [
                'cho_xac_nhan',
                'da_xac_nhan',
                'dang_giao',
                'da_giao',
                'da_huy'
            ])->default('cho_xac_nhan');
            $table->string('dia_chi_giao');
            $table->string('so_dien_thoai');
            $table->text('ghi_chu')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('don_hang');
    }
}; 