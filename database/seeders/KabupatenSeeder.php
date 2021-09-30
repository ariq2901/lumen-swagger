<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kabupaten')->insert([
            [
                'provinsi_id' => 1,
                'name' => 'Kabupaten Bandung',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 1,
                'name' => 'Kabupaten Bandung Barat',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 1,
                'name' => 'Kabupaten Bekasi',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 1,
                'name' => 'Kabupaten Bogor',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 1,
                'name' => 'Kabupaten Ciamis',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 1,
                'name' => 'Kabupaten Cianjur',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 2,
                'name' => 'Kabupaten Banjarnegara',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 2,
                'name' => 'Kabupaten Banyumas',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 2,
                'name' => 'Kabupaten Boyolali',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 2,
                'name' => 'Kabupaten Cilacap',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 2,
                'name' => 'Kabupaten Demak',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 3,
                'name' => 'Kabupaten Bangkalan',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 3,
                'name' => 'Kabupaten Banyuwangi',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 3,
                'name' => 'Kabupaten Blitar',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 3,
                'name' => 'Kabupaten Bojonegoro',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 3,
                'name' => 'Kabupaten Bondowoso',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'provinsi_id' => 3,
                'name' => 'Kabupaten Gresik',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
