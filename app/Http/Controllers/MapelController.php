<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Kelas;
use Yajra\DataTables\Facades\DataTables;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Mapel::query()->count();
		
		return view('mapel.index', ['jumlah' => $jumlah]);
    }
	
	public function getDataMapel(Request $request)
	{
		if ($request->ajax()) {
            $data = Mapel::with(['kelas'])->get();
            return DataTables::of($data)
				->addColumn('kelas', function ($d) {
					return $d->kelas->kelas;
				})
                ->addColumn('aksi', function ($d) {
                    return
                        '<div class="text-right"><div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil-alt text-white"></i></button>
                            <button type="button" class="btn btn-danger btn-hapus" data-id="' . $d->id . '"><i class="fa fas fa-trash"></i></button>
                        </div></div>';
                })
                ->rawColumns(['kelas', 'aksi'])
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
		$kelas = Kelas::all(['id', 'kelas']);
        return view('mapel.create', ['kelas' => $kelas]);
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
			'nama' => ['required'],
			'kelas_id' => ['required']
		]);
		
		$check = Mapel::query()->where('nama', $validated['nama'])->where('kelas_id', $validated['kelas_id'])->count();
		if(!empty($check)) {
			return back()->withInput()->withErrors(['nama' => 'The nama has already been taken', 'kelas_id' => 'The kelas id has already been taken']);
		}
		
		Mapel::create($validated);
		
		return redirect()->route('mapel.index');
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
		// Ambil data mapel
		$mapel = Mapel::find($id);
		$kelas = Kelas::all(['id', 'kelas']);
		
        return view('mapel.edit', ['data' => $mapel, 'kelas' => $kelas]);
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
			'nama' => ['required'],
			'kelas_id' => ['required']
		]);
		
		Mapel::query()->where('id', $id)->update($validated);
		
		return redirect()->route('mapel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mapel::destroy($id);
		
		return redirect()->route('mapel.index');
    }
}
