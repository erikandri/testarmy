<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Nilai::query()->count();

		return view('nilai.index', ['jumlah' => $jumlah]);
    }

    /**
     * @throws \Exception
     */
    public function getDataNilai(Request $request)
	{
		if ($request->ajax()) {
            $data = Nilai::with(['siswa:id,nama,kelas_id', 'mapel:id,nama'])->get();
            return DataTables::of($data)
				->addColumn('siswa', function ($d) {
					return $d->siswa->nama;
				})
				->addColumn('mapel', function ($d) {
					return $d->mapel->nama;
				})
                ->addColumn('kelas', function ($d) {
                    return $d->siswa->kelas->kelas;
                })
                ->addColumn('aksi', function ($d) {
                    return
                        '<div class="text-right"><div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil-alt text-white"></i></button>
                            <button type="button" class="btn btn-danger btn-hapus" data-id="' . $d->id . '"><i class="fa fas fa-trash"></i></button>
                        </div></div>';
                })
                ->rawColumns(['siswa', 'mapel', 'kelas', 'aksi'])
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
		// Ambil data kebutuhan relasi
		$siswa = Siswa::all(['id', 'nama']);

        return view('nilai.create', ['siswa' => $siswa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $mapel_id = (int) $request->input('mapel_id');
        $validated = $request->validate([
			'siswa_id' => ['required', 'integer', Rule::unique('nilai', 'siswa_id')->where(function ($request) use($mapel_id) {
			    return $request->where('mapel_id', $mapel_id);
            })],
			'mapel_id' => ['required', 'integer'],
			'nilai' => ['required', 'integer']
		]);

		$nilai = Nilai::query()->create($validated);

		return redirect()->route('nilai.index')->with('controller_feedback', 'Berhasil Membuat Nilai Untuk ' . $nilai->siswa->nama . ' !');
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
		// Ambil data
		$data = Nilai::query()->find($id);

        return view('nilai.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
			'nilai' => ['required', 'integer']
		]);

		$siswaquery = Nilai::query()->find($id);
		$siswa = $siswaquery->getRelationValue('siswa')->nama;
		Nilai::query()->where('id', $id)->update($validated);

		return redirect()->route('nilai.index')->with('controller_feedback', 'Berhasil Memperbarui Nilai dari ' . $siswa . ' !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $siswaquery = Nilai::query()->find($id);
        $siswa = $siswaquery->getRelationValue('siswa')->nama;

        Nilai::destroy($id);

		return redirect()->route('nilai.index')->with('controller_feedback', 'Berhasil Menghapus Nilai dari ' . $siswa . ' !');
    }
}
