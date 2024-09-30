<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Divisi;
use App\Models\User;
use App\Models\Periode;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $divisi = [
            [
                'divisi' => 'admin',
                'singkatan' => 'admin',
            ],
            [
                'divisi' => 'Ketua Sekretaris Bendahara',
                'singkatan' => 'ksb',
            ],
            [
                'divisi' => 'Kaderisasi dan Advokasi',
                'singkatan' => 'kaderisasi-advokasi',
            ],
            [
                'divisi' => 'Pemberdayaan Sumber Daya Mahasiswa dan Riset Teknologi',
                'singkatan' => 'psdm',
            ],
            [
                'divisi' => 'Kerohanian',
                'singkatan' => 'kerohanian',
            ],
            [
                'divisi' => 'Hubungan Masyarakat',
                'singkatan' => 'humas',
            ],
            [
                'divisi' => 'Komunikasi dan Informasi',
                'singkatan' => 'kominfo',
            ],
            [
                'divisi' => 'Kewirausahaan',
                'singkatan' => 'kwu',
            ]
        ];

        foreach ($divisi as $item) {
            DB::table('divisi')->insert([
                'divisi' => $item['divisi'],
                'singkatan' => $item['singkatan'],
                'created_at' => now(),
            ]);
        }

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
            'divisi_id' => 1,
            'jabatan' => 'admin',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '110022999'
        ]);

        User::factory()->create([
            'name' => 'Ihkram Mulya',
            'email' => 'ihkram@gmail.com',
            'password' => bcrypt('210401108'),
            'divisi_id' => 2,
            'jabatan' => 'bupati',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '210401108'
        ]);
        User::factory()->create([
            'name' => 'Angga Yudha Wibowo',
            'email' => 'angga@gmail.com',
            'password' => bcrypt('210401133'),
            'divisi_id' => 2,
            'jabatan' => 'wakil_bupati',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '210401133'
        ]);
        User::factory()->create([
            'name' => 'Fahriasalsabilla',
            'email' => 'caca@gmail.com',
            'password' => bcrypt('210401245'),
            'divisi_id' => 2,
            'jabatan' => 'sekum',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '210401245'
        ]);
        User::factory()->create([
            'name' => 'Paula Carnelian',
            'email' => 'paula@gmail.com',
            'password' => bcrypt('220401156'),
            'divisi_id' => 2,
            'jabatan' => 'sekretaris',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '220401156'
        ]);
        User::factory()->create([
            'name' => 'Fauza Addinunnisa',
            'email' => 'fauza@gmail.com',
            'password' => bcrypt('210401130'),
            'divisi_id' => 2,
            'jabatan' => 'bendum',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '210401130'
        ]);
        User::factory()->create([
            'name' => 'Diva Salsabilla',
            'email' => 'diva@gmail.com',
            'password' => bcrypt('220401040'),
            'divisi_id' => 7,
            'jabatan' => 'kadiv',
            'gender' => 'P',
            'periode_id' => 1,
            'nim' => '220401040'
        ]);
        User::factory()->create([
            'name' => 'Muhammad Farhan',
            'email' => 'farhan@gmail.com',
            'password' => bcrypt('230401089'),
            'divisi_id' => 7,
            'jabatan' => 'anggota',
            'gender' => 'L',
            'periode_id' => 1,
            'nim' => '230401089'
        ]);

        DB::table('pengaturan_pendaftaran')->insert([
            'tanggal_mulai' => date('Y-m-d'),
            'tanggal_selesai' => date('Y-m-d', strtotime('+30 days')),
            'deskripsi' => 'Pendaftaran dilakukan selama 30 hari',
            'status' => 'ditutup'
        ]);

        Categories::create([
            'category' => 'Teknologi',
            'slug' => 'teknologi',
            'created_at' => now()
        ]);
    }
}
