<?php

namespace Database\Seeders;

use App\Models\NguoiDung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NguoiDung::create([
            'ten' => 'Admin',
            'email' => 'admin@gmail.com',
            'mat_khau' => Hash::make('123456789'),
            'vai_tro' => 'admin',
        ]);
    }
}
