<?php

namespace Database\Factories;

use App\Models\DanhMuc;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SanPham>
 */
class SanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ten = fake()->unique()->words(4, true);
        return [
            'ten_san_pham' => $ten,
            'slug' => Str::slug($ten),
            'mo_ta' => fake()->paragraphs(3, true),
            'gia' => fake()->numberBetween(50000, 10000000),
            'so_luong' => fake()->numberBetween(0, 100),
            'anh_dai_dien' => 'default-product.jpg',
            'danh_muc_id' => DanhMuc::inRandomOrder()->first()->id ?? DanhMuc::factory()->create()->id,
            'hien_thi' => fake()->boolean(80),
            'noi_bat' => fake()->boolean(20), // 20% chance of being true
        ];
    }
}
