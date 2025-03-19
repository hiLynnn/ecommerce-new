<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DanhMuc>
 */
class DanhMucFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ten = fake()->unique()->words(3, true);
        return [
            'ten_danh_muc' => $ten,
            'slug' => Str::slug($ten),
            'mo_ta' => fake()->paragraph(),
            'hien_thi' => fake()->boolean(80), // 80% chance of being true
        ];
    }
}
