<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$jumlah = Siswa::query()->count();
        return view('siswa.index', ['jumlah' => $jumlah]);
    }
	
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
					return '<a class="btn btn-sm btn-primary fa fas fa-file" href="' . asset('storage/' . $d->foto) . '"> Lihat</a>';
				})
                ->addColumn('aksi', function ($d) {
                    return
                        '<div class="text-right"><div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary btn-show" data-id="' . $d->id . '"><i class="fa fas fa-eye text-white"></i></button>
							<button type="button" class="btn btn-warning btn-edit" data-id="' . $d->id . '"><i class="fa fas fa-pencil-alt text-white"></i></button>
                            <button type="button" class="btn btn-danger btn-hapus" data-id="' . $d->id . '"><i class="fa fas fa-trash"></i></button>
                        </div></div>';
                })
                ->rawColumns(['induk', 'alamat', 'kelas', 'foto', 'aksi'])
                ->make(true);
        }
	}
	
	public function download($siswa)
	{
		$path = Siswa::find($siswa)->foto;
		return Storage::download('public/' . $path);
	}
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
			'nama' => ['required'],
			'nis' => ['required', 'integer', 'unique:siswa,nis'],
			'nisn' => ['required', 'integer', 'unique:siswa,nisn'],
			'foto' => ['required', 'file', 'image'],
			'alamat' => ['required'],
			'kelas_id' => ['required', 'integer']
		]);
		$file_ex = "." . $request->file('foto')->getClientOriginalExtension();
        $nama = $request->file('foto')->getClientOriginalName();
		$file = "siswa_" . $validated['nisn'] . $file_ex;
		$path = $request->file('foto')->storeAs('foto', $file, 'public');
        //$path = $request->file('foto')->storeAs('foto', $file);
		//$path = Storage::putFileAs('foto', $request->file('foto'), 'public');
		
		Siswa::create([
			'nama' => $validated['nama'],
			'nis' => $validated['nis'],
			'nisn' => $validated['nisn'],
			'foto' => $path,
			'alamat' => $validated['alamat'],
			'kelas_id' => $validated['kelas_id']
		]);
		
		return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		// Ambil data
		$siswa = Siswa::find($id);
		
        return view('siswa.show', ['data' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// Ambil data siswa
		$siswa = Siswa::find($id);
		$kelas = Kelas::all(['id', 'kelas']);
		
        return view('siswa.edit', ['data' => $siswa, 'kelas' => $kelas]);
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
			'nis' => ['required', 'integer', 'unique:siswa,nis'],
			'nisn' => ['required', 'integer', 'unique:siswa,nisn'],
			//'foto' => ['required', 'file', 'image'],
			'alamat' => ['required'],
			'kelas_id' => ['required', 'integer']
		]);
		
		// Pengecekan path file
		$siswa = Siswa::find($id);
		$file_db = $siswa->foto;
		$file = $request->file('foto');
		
		if(empty($file)) {
			$siswa->update($validated);
		} else {
			$a = Storage::delete('public/' . $file_db);
			$file_ex = "." . $request->file('foto')->getClientOriginalExtension();
			$nama = "siswa_" . $validated['nisn'] . $file_ex;
			$path = $request->file('foto')->storeAs('foto', $nama, 'public');
			$siswa->update([
				'nama' => $validated['nama'],
				'nis' => $validated['nis'],
				'nisn' => $validated['nisn'],
				'foto' => $path,
				'alamat' => $validated['alamat'],
				'kelas_id' => $validated['kelas_id'],
			]);
		}
		
		return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$file = Siswa::find($id)->foto;
        Siswa::destroy($id);
		Storage::delete('public/' . $file);
		
		return redirect()->route('siswa.index');
    }
}
