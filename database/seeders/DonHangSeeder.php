<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\NguoiDung;
use App\Models\SanPham;
use Faker\Factory as Faker;

class DonHangSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        
        // Lấy danh sách người dùng và sản phẩm
        $nguoiDungs = NguoiDung::where('vai_tro', 'user')->get();
        $sanPhams = SanPham::all();

        // Tạo 50 đơn hàng mẫu
        foreach(range(1, 50) as $index) {
            $nguoiDung = $nguoiDungs->random();
            
            // Tạo đơn hàng
            $donHang = DonHang::create([
                'nguoi_dung_id' => $nguoiDung->id,
                'tong_tien' => 0, // Sẽ cập nhật sau
                'trang_thai' => $faker->randomElement([
                    'cho_xac_nhan',
                    'da_xac_nhan',
                    'dang_giao',
                    'da_giao',
                    'da_huy'
                ]),
                'dia_chi_giao' => $nguoiDung->dia_chi ?: $faker->address,
                'so_dien_thoai' => $nguoiDung->so_dien_thoai ?: $faker->phoneNumber,
                'ghi_chu' => $faker->optional(0.7)->sentence,
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);

            // Tạo chi tiết đơn hàng
            $soSanPham = rand(1, 5); // Mỗi đơn 1-5 sản phẩm
            $tongTien = 0;

            for($i = 0; $i < $soSanPham; $i++) {
                $sanPham = $sanPhams->random();
                $soLuong = rand(1, 5);
                $donGia = $sanPham->gia;
                $thanhTien = $soLuong * $donGia;
                $tongTien += $thanhTien;

                ChiTietDonHang::create([
                    'don_hang_id' => $donHang->id,
                    'san_pham_id' => $sanPham->id,
                    'so_luong' => $soLuong,
                    'don_gia' => $donGia,
                    'thanh_tien' => $thanhTien,
                ]);
            }

            // Cập nhật tổng tiền đơn hàng
            $donHang->update(['tong_tien' => $tongTien]);
        }
    }
} 