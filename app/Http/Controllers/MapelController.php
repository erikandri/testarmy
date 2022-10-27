<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Mapel::query()->count();

		return view('mapel.index', ['jumlah' => $jumlah]);
    }

    /**
     * @throws \Exception
     */
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
                            <button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil text-white"></i></button>
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $kelas_id = (int) $request->input('kelas_id');
        $validated = $request->validate([
			'nama' => ['required', Rule::unique('mapel', 'nama')->where(function ($request) use ($kelas_id) {
			    $request->where('kelas_id', $kelas_id);
            })],
			'kelas_id' => ['required']
		]);

		$mapel = Mapel::query()->create($validated);

		return redirect()->route('mapel.index')->with('controller_feedback', 'Berhasil Membuat Mata Pelajaran ' . $validated['nama'] . ' di Kelas ' . $mapel->kelas->kelas . ' !');
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $id)
    {
		// Ambil data mapel
		$mapel = Mapel::query()->find($id);
		$kelas = Kelas::all(['id', 'kelas']);

        return view('mapel.edit', ['data' => $mapel, 'kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $kelas_id = (int) $request->input('kelas_id');
        $validated = $request->validate([
			'nama' => ['required', Rule::unique('mapel', 'nama')->where(function ($query) use ($kelas_id) {
			    return $query->where('kelas_id', $kelas_id);
            })->ignore($id)],
			'kelas_id' => ['required', 'integer']
		]);

		$kelasquery = Kelas::query()->find($kelas_id);
		$kelas = $kelasquery->getAttribute('kelas');
		Mapel::query()->where('id', $id)->update($validated);

		return redirect()->route('mapel.index')->with('controller_feedback', 'Berhasil Memperbarui Mata Pelajaran ' . $validated['nama'] . ' di Kelas ' . $kelas . ' !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $mapel = Mapel::query()->find($id);

        // Periksa Relasi Tabel
        $checkRelation = array();
        $checkRelation[] = $mapel->getRelationValue('nilai');
        foreach($checkRelation as $value) {
            if ($value !== null) {
                return redirect()->route('mapel.index')->with('relation', 'Tabel ini memiliki relasi ke tabel Nilai, Pastikan anda menghapus semua data relasi sebelum menghapus Data Mata Pelajaran ' . $mapel->getAttribute('nama') . ' di kelas ' . $mapel->kelas->kelas . '!');
            }
        }

        Mapel::destroy($id);

		return redirect()->route('mapel.index')->with('controller_feedback', 'Berhasil Menghapus Mata Pelajaran ' . $mapel->getAttribute('nama') . ' di Kelas ' . $mapel->getRelationValue('kelas')->kelas . ' !');
    }
}
