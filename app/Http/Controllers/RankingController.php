<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use Yajra\DataTables\Facades\DataTables;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Nilai::query()->count();
		
		return view('ranking.index', ['jumlah' => $jumlah]);
    }
	
	public function getDataRanking(Request $request)
	{
		if ($request->ajax()) {
            $data = Nilai::query()->with('siswa:id,nama')->groupBy('siswa_id')->selectRaw('sum(nilai) as total, siswa_id')->get();
            return DataTables::of($data)
				->addColumn('siswa', function ($d) {
					return $d->siswa->nama;
				})
				->addColumn('nilai', function ($d) {
					return $d->total;
				})
                ->rawColumns(['siswa', 'nilai'])
                ->make(true);
        }
	}
}
