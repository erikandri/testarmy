<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
			'kelas' => '1'
		]);
		Kelas::create([
			'kelas' => '2'
		]);
		Kelas::create([
			'kelas' => '3'
		]);
    }
}
