<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Mapel;
use Yajra\DataTables\Facades\DataTables;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Nilai::query()->count();
		
		return view('nilai.index', ['jumlah' => $jumlah]);
    }
	
	public function getDataNilai(Request $request)
	{
		if ($request->ajax()) {
            $data = Nilai::with(['siswa:id,nama', 'mapel:id,nama'])->get();
            return DataTables::of($data)
				->addColumn('siswa', function ($d) {
					return $d->siswa->nama;
				})
				->addColumn('mapel', function ($d) {
					return $d->mapel->nama;
				})
                ->addColumn('aksi', function ($d) {
                    return
                        '<div class="text-right"><div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil-alt text-white"></i></button>
                            <button type="button" class="btn btn-danger btn-hapus" data-id="' . $d->id . '"><i class="fa fas fa-trash"></i></button>
                        </div></div>';
                })
                ->rawColumns(['siswa', 'mapel', 'aksi'])
                ->make(true);
        }
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// Ambil data kebutuhan relasi
		$siswa = Siswa::all(['id', 'nama']);
		
        return view('nilai.create', ['siswa' => $siswa, 'mapel' => $mapel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
			'siswa_id' => ['required', 'integer'],
			'mapel_id' => ['required', 'integer'],
			'nilai' => ['required', 'integer']
		]);
		
		// Double check to prevent inspect element!
		$cnil = Nilai::query()->where('siswa_id', $validated['siswa_id'])->where('mapel_id', $validated['mapel_id'])->pluck('id')->first();
		if(!empty($cnil)) {
			return back()->withInput()->withErrors(['siswa_id' => 'The siswa id has already been taken', 'mapel_id' => 'The mapel id has already been taken']);
		}
		
		Nilai::create($validated);
		
		return redirect()->route('nilai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// Ambil data
		$data = Nilai::find($id);
		
        return view('nilai.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
			'nilai' => ['required', 'integer']
		]);
		
		Nilai::query()->where('id', $id)->update($validated);
		
		return redirect()->route('nilai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nilai::destroy($id);
		
		return redirect()->route('nilai.index');
    }
}
