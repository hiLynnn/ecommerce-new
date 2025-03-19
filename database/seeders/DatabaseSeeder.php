<?php

namespace Database\Seeders;

use App\Models\NguoiDung;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Xóa hoặc bình luận dòng này nếu có
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            AdminSeeder::class,
        ]);

        // Tạo 10 người dùng mẫu
        NguoiDung::factory(10)->create();

        // Tạo 5 danh mục mẫu
        \App\Models\DanhMuc::factory(5)->create();

        // Tạo 20 sản phẩm mẫu
        \App\Models\SanPham::factory(20)->create()->each(function($sanPham) {
            // Mỗi sản phẩm có 2-4 ảnh phụ
            $soAnhPhu = rand(2, 4);
            for($i = 0; $i < $soAnhPhu; $i++) {
                \App\Models\AnhPhuSanPham::factory()->create([
                    'san_pham_id' => $sanPham->id
                ]);
            }
        });

        // Tạo đơn hàng mẫu
        $this->call([
            DonHangSeeder::class,
        ]);
    }
}
