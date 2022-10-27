<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
		$jumlah = Siswa::query()->count();
        return view('siswa.index', ['jumlah' => $jumlah]);
    }

    /**
     * @throws \Exception
     */
    public function getDataSiswa(Request $request)
	{
		if ($request->ajax()) {
            $data = Siswa::with(['kelas'])->get();
            return DataTables::of($data)
				->addColumn('induk', function ($d) {
					return '
						<button type="button" class="btn btn-primary btn-sm bpop" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="focus" data-html="true" data-content="NIS: ' . $d->nis . '<br>NISN: ' . $d->nisn . '">
							<i class="fa fas fa-info-circle" style="font-size: 100%; vertical-align: middle;"></i> Lihat Disini
						</button>
					';
				})
				->addColumn('alamat', function ($d) {
					return '
						<button type="button" class="btn btn-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="focus" data-html="true" data-content="' . $d->alamat . '">
							<i class="fa fas fa-info-circle" style="font-size: 100%; vertical-align: middle;"></i> Lihat Disini
						</button>
					';
				})
				->addColumn('kelas', function ($d) {
					return $d->kelas->kelas;
				})
				->addColumn('foto', function ($d) {
					return '<a class="btn btn-sm btn-primary fa fas fa-file" href="' . Storage::url($d->foto) . '"> Lihat</a>';
				})
                ->addColumn('aksi', function ($d) {
                    return
                        '<div class="text-right"><div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary btn-show" data-id="' . $d->id . '"><i class="fa fas fa-eye text-white"></i></button>
							<button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil text-white"></i></button>
                            <button type="button" class="btn btn-danger btn-hapus" data-id="' . $d->id . '"><i class="fa fas fa-trash"></i></button>
                        </div></div>';
                })
                ->rawColumns(['induk', 'alamat', 'kelas', 'foto', 'aksi'])
                ->make(true);
        }
	}

	public function download($siswa)
	{
		$siswa = Siswa::query()->find($siswa);
		$path = $siswa->getAttribute('foto');
        if(Storage::disk('public')->exists($path)) {
            return Storage::download('public/' . $path);
        }
        return back();
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
		// Ambil data Kelas
		$kelas = Kelas::all(['id', 'kelas']);

        return view('siswa.create', ['kelas' => $kelas]);
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
			'nama' => ['required'],
			'nis' => ['required', 'integer', 'unique:siswa,nis'],
			'nisn' => ['required', 'integer', 'unique:siswa,nisn'],
			'foto' => ['required', 'file', 'image'],
			'alamat' => ['required'],
			'kelas_id' => ['required', 'integer']
		]);
        $file = $request->file('foto');
        $path = $file->store('foto', 'public');
        $validated['foto'] = $path;

		Siswa::query()->create($validated);

		return redirect()->route('siswa.index')->with('controller_feedback', 'Berhasil Membuat Siswa Baru Bernama ' . $validated['nama'] . ' !');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(int $id)
    {
		// Ambil data
		$siswa = Siswa::query()->find($id);

        return view('siswa.show', ['data' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int $id)
    {
		// Ambil data siswa
		$siswa = Siswa::query()->find($id);
		$kelas = Kelas::all(['id', 'kelas']);

        return view('siswa.edit', ['data' => $siswa, 'kelas' => $kelas]);
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
        $validated = $request->validate([
			'nama' => ['required'],
			'nis' => ['required', 'integer', 'unique:siswa,nis,'.$id],
			'nisn' => ['required', 'integer', 'unique:siswa,nisn,'.$id],
			'foto' => ['nullable', 'file', 'image'],
			'alamat' => ['required'],
			'kelas_id' => ['required', 'integer']
		]);

		// Pengecekan path file
		$siswa = Siswa::query()->find($id);
		$file_db = $siswa->getAttribute('foto');
		$file = $request->file('foto');

		if(!empty($file)) {
            Storage::delete('public/' . $file_db);
            $file = $request->file('foto');
            $path = $file->store('foto', 'public');
            $validated['foto'] = $path;
        }
        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('controller_feedback', 'Berhasil Memperbarui Siswa Bernama ' . $validated['nama'] . ' !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $siswa = Siswa::query()->find($id);
        $file = $siswa->getAttribute('foto');

        // Periksa Relasi Tabel
        $checkRelation = array();
        $checkRelation[] = $siswa->getRelationValue('nilai');
        foreach($checkRelation as $value) {
            if ($value !== null) {
                return redirect()->route('siswa.index')->with('relation', 'Tabel ini memiliki relasi ke tabel Nilai, Pastikan anda menghapus semua data relasi sebelum menghapus Data Siswa ' . $siswa->getAttribute('nama') . '!');
            }
        }

        Siswa::destroy($id);
		Storage::delete('public/' . $file);

		return redirect()->route('siswa.index')->with('controller_feedback', 'Berhasil Menghapus Siswa Bernama ' . $siswa->nama . ' !');
    }
}
