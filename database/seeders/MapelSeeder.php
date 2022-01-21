<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mapel::create([
			'nama' => 'Bahasa Indonesia',
			'kelas_id' => '1'
		]);
		Mapel::create([
			'nama' => 'Matematika',
			'kelas_id' => '1'
		]);
		Mapel::create([
			'nama' => 'Bahasa Indonesia',
			'kelas_id' => '2'
		]);
		Mapel::create([
			'nama' => 'Matematika',
			'kelas_id' => '2'
		]);
		Mapel::create([
			'nama' => 'Bahasa Indonesia',
			'kelas_id' => '3'
		]);
		Mapel::create([
			'nama' => 'Matematika',
			'kelas_id' => '3'
		]);
    }
}
