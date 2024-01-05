<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Waktu_absensi;
use App\Models\Tugasconfig;

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
        $waktu_absensi = Waktu_absensi::find(1);

        if (!empty($waktu_absensi)) {
            $waktu_absensi->update([
                'awalMasuk' => '08:00',
                'akhirMasuk' => '08:15',
                'awalKeluar' => '16:00',
                'akhirKeluar' => '20:00',
            ]);
        } else {
            Waktu_absensi::create([
                'awalMasuk' => '08:00',
                'akhirMasuk' => '08:15',
                'awalKeluar' => '16:00',
                'akhirKeluar' => '20:00',
            ]);
        }

        $tugasConfig = Tugasconfig::find(1);

        if (!empty($tugasConfig)) {
            $tugasConfig->update([
                'filter_tugas_admin' => 0,
            ]);
        } else {
            Tugasconfig::create([
                'filter_tugas_admin' => 0,
            ]);
        }
        
    }
}
