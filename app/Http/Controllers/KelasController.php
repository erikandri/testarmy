<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Kelas::query()->count();
		return view('kelas.index', ['jumlah' => $jumlah]);
    }
	
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
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
			'kelas' => ['required', 'integer', 'unique:kelas,kelas']
		]);
		
		Kelas::create($validated);
		
		return redirect()->route('kelas.index');
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
        // Ambil data kelas
		$data = Kelas::find($id);
		
		return view('kelas.edit', ['data' => $data]);
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
			'kelas' => ['required', 'integer', 'unique:kelas,kelas']
		]);
		
		Kelas::query()->where('id', $id)->update($validated);
		
		return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::destroy($id);
		
		return redirect()->route('kelas.index');
    }
}
