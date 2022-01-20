<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
	{
		$siswa = Siswa::query()->count();
		$mapel = Mapel::query()->count();
		$guru = User::query()->count();

		return view('dashboard', ['siswa' => $siswa, 'mapel' => $mapel, 'guru' => $guru]);
	}
}
