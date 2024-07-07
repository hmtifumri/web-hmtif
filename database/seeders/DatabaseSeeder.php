<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Periode;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Periode::create([
            'periode' => '2023/2024',
            'status' => 'aktif'
         ]);
        Periode::create([
            'periode' => '2024/2025',
            'status' => 'tidak aktif'
         ]);
         
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'divisi' => 'admin',
            'jabatan' => 'admin',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '230401089'
        ]);

        User::factory()->create([
            'name' => 'Ihkram Mulya',
            'email' => 'ihkram@gmail.com',
            'password' => bcrypt('ihkram123'),
            'divisi' => 'ksb',
            'jabatan' => 'bupati',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '230401090'
        ]);
        User::factory()->create([
            'name' => 'Angga Yudha Wibowo',
            'email' => 'angga@gmail.com',
            'password' => bcrypt('angga123'),
            'divisi' => 'ksb',
            'jabatan' => 'wakil_bupati',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '230401091'
        ]);
        User::factory()->create([
            'name' => 'Fahriasalsabilla',
            'email' => 'caca@gmail.com',
            'password' => bcrypt('caca123'),
            'divisi' => 'ksb',
            'jabatan' => 'sekum',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '230401092'
        ]);
        User::factory()->create([
            'name' => 'Fauza Addinunnisa',
            'email' => 'fauza@gmail.com',
            'password' => bcrypt('fauza123'),
            'divisi' => 'ksb',
            'jabatan' => 'bendum',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '230401093'
        ]);
        User::factory()->create([
            'name' => 'Diva Salsabilla',
            'email' => 'diva@gmail.com',
            'password' => bcrypt('diva123'),
            'divisi' => 'kominfo',
            'jabatan' => 'kadiv',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '230401094'
        ]);
        User::factory()->create([
            'name' => 'Muhammad Farhan',
            'email' => 'farhan@gmail.com',
            'password' => bcrypt('farhan123'),
            'divisi' => 'kominfo',
            'jabatan' => 'anggota',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '230401095'
        ]);

        DB::table('pengaturan_pendaftaran')->insert([
            'tanggal_mulai' => date('Y-m-d'),
            'tanggal_selesai' => date('Y-m-d', strtotime('+30 days')),
            'deskripsi' => 'Pendaftaran dilakukan selama 30 hari',
            'status' => 'ditutup'
        ]);
    }
}
