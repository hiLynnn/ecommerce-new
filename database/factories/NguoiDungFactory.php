<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NguoiDung>
 */
class NguoiDungFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'mat_khau' => bcrypt('123456789'),
            'so_dien_thoai' => fake()->phoneNumber(),
            'dia_chi' => fake()->address(),
            'vai_tro' => 'user',
            'remember_token' => Str::random(10),
        ];
    }
}
