<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Petugas;
use App\Models\Ortu;
use App\Models\Training;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('trainings')->insert([
            [
                'umur' => 12,  // 1 tahun
                'berat_badan' => 10.5,
                'tinggi_badan' => 75.0,
                'lingkar_atas' => 11.0,
                'status' => 'absence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 18,  // 1.5 tahun
                'berat_badan' => 11.0,
                'tinggi_badan' => 80.0,
                'lingkar_atas' => 12.0,
                'status' => 'presence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 24,  // 2 tahun
                'berat_badan' => 12.5,
                'tinggi_badan' => 85.0,
                'lingkar_atas' => 13.0,
                'status' => 'absence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 30,  // 2.5 tahun
                'berat_badan' => 13.0,
                'tinggi_badan' => 90.0,
                'lingkar_atas' => 13.5,
                'status' => 'presence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 36,  // 3 tahun
                'berat_badan' => 14.0,
                'tinggi_badan' => 95.0,
                'lingkar_atas' => 14.0,
                'status' => 'absence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 42,  // 3.5 tahun
                'berat_badan' => 15.0,
                'tinggi_badan' => 100.0,
                'lingkar_atas' => 14.5,
                'status' => 'presence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 48,  // 4 tahun
                'berat_badan' => 16.0,
                'tinggi_badan' => 105.0,
                'lingkar_atas' => 15.0,
                'status' => 'absence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 54,  // 4.5 tahun
                'berat_badan' => 17.0,
                'tinggi_badan' => 110.0,
                'lingkar_atas' => 15.5,
                'status' => 'presence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 60,  // 5 tahun
                'berat_badan' => 18.0,
                'tinggi_badan' => 115.0,
                'lingkar_atas' => 16.0,
                'status' => 'absence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umur' => 66,  // 5.5 tahun
                'berat_badan' => 19.0,
                'tinggi_badan' => 120.0,
                'lingkar_atas' => 16.5,
                'status' => 'presence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Petugas::create([
            'id_puskesmas' => '1',
            'id_posyandu' => '1',
            'nama' => 'Sindi Oktafianti',
            'jk' => 'Perempuan',
            'jabatan' => 'Kader',
            'role' => 'Super Admin',
            'email' => 'oktafiantisindi@gmail.com',
            'no_tlp' => '08986004677',
            'username' => 'sindi.okto',
            'password' => bcrypt('123456'),
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        Ortu::create([
            'id_kb' => '1',
            'NIK' => '3204320712000008',
            'nama' => 'Sindi Oktafianti',
            'alamat' => 'Kp. Cibaduyut Indah',
            'email' => 'oktafiantisindi@gmail.com',
            'no_telp' => '08986004677',
            'username' => 'sindi.okto',
            'password' => bcrypt('123456'),
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
