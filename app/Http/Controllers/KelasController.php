<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Kelas::query()->count();
		return view('kelas.index', ['jumlah' => $jumlah]);
    }

    /**
     * @throws \Exception
     */
    public function getDataKelas(Request $request)
	{
		if ($request->ajax()) {
            $data = Kelas::all();
            return DataTables::of($data)
                ->addColumn('aksi', function ($d) {
                    return
                        '<div class="text-right"><div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil-alt text-white"></i></button>
                            <button type="button" class="btn btn-danger btn-hapus" data-id="' . $d->id . '"><i class="fa fas fa-trash"></i></button>
                        </div></div>';
                })
                ->rawColumns(['aksi'])
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
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
			'kelas' => ['required', 'integer', 'unique:kelas,kelas']
		]);

		Kelas::query()->create($validated);

		return redirect()->route('kelas.index')->with('controller_feedback', 'Berhasil Membuat Kelas ' . $validated['kelas'] . ' !');
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
        // Ambil data kelas
		$data = Kelas::query()->find($id);

		return view('kelas.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
			'kelas' => ['required', 'integer', Rule::unique('kelas', 'kelas')->ignore($id)]
		]);

		Kelas::query()->where('id', $id)->update($validated);

		return redirect()->route('kelas.index')->with('controller_feedback', 'Berhasil Memperbarui Kelas ' . $validated['kelas'] . ' !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $kelas = Kelas::query()->find($id);

        // Pemeriksaan Relasi Tabel
        $checkRelation = array();
        $checkRelation[] = $kelas->getRelationValue('siswa');
        $checkRelation[] = $kelas->getRelationValue('mapel');
        foreach($checkRelation as $value) {
            if ($value !== null) {
                return redirect()->route('kelas.index')->with('relation', 'Tabel ini memiliki relasi ke tabel Siswa dan Mata Pelajaran, Pastikan anda menghapus semua data relasi sebelum menghapus Data Kelas ' . $kelas->getAttribute('kelas') . '!');
            }
        }

        Kelas::destroy($id);

		return redirect()->route('kelas.index')->with('controller_feedback', 'Berhasil Menghapus Kelas ' . $kelas->getAttribute('kelas') . ' !');
    }
}
