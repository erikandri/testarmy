<?php
// Internal API Function Helpers

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Mapel;

function mapelExist($siswa_id, $mapel_id)
{
	$siswa_id = (int) $siswa_id;
	$mapel_id = (int) $mapel_id;
	$check = Nilai::query()->where('siswa_id', $siswa_id)->where('mapel_id', $mapel_id)->count();
	
	return (bool) $check;
}

function siswaExist($siswa_id)
{
	$siswa_id = (int) $siswa_id;
	$check = Siswa::find($siswa_id);
	
	return (bool) !empty($check);
}

function getMapel($siswa_id)
{
	$kelas_id = Siswa::find($siswa_id)->kelas_id;
	$mapel = Mapel::query()->where('kelas_id', $kelas_id)->get();
	
	return $mapel;
}

?>

@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    @section('halaman', 'Tambah Data Nilai')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Masukan Data Nilai Baru</h4>
                    </div>
                    <form method="POST" action="{{ route('nilai.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="siswa_id">Nama Siswa</label>
							<select id="siswa_id" class="select2-single form-control @error('siswa_id') is-invalid @enderror" name="siswa_id">
								<option @if(empty(request('siswa')) && empty(old('siswa_id'))) selected @endif disabled> Pilih nama siswa di bawah ini</option>
								@foreach($siswa as $d)
									@if( empty(request('siswa')) || (!empty(request('siswa')) && siswaExist(request('siswa'))) )
										<option value="{{ $d->id }}" @if(request('siswa') == $d->id || old('siswa_id') == $d->id) selected @endif>{{ $d->nama }}</option>
									@endif
								@endforeach
							</select>

                            @error('siswa_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="mapel_id">Nama Mata Pelajaran</label>
							<select id="mapel_id" class="select2-single form-control @error('mapel_id') is-invalid @enderror" name="mapel_id">
								<option selected disabled>Pilih mata pelajaran di bawah ini</option>
								@if(!empty(request('siswa')) && siswaExist(request('siswa')))
									@foreach(getMapel(request('siswa')) as $d)
										@if(!mapelExist(request('siswa'), $d->id))
											<option value="{{ $d->id }}">{{ $d->nama }}</option>
										@endif
									@endforeach
								@endif
							</select>

                            @error('mapel_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                   id="nilai"
                                   name="nilai"
                                   value="{{ old('nilai') }}" autocomplete @if(!siswaExist(request('siswa'))) disabled placeholder="Siswa tidak terdaftar di dalam basis data!" @else placeholder="Masukan nilai" @endif>

                            @error('nilai')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
	<script>
		$("#siswa_id").on('change', function (event) {
			let value = $(this).val();
			window.location.href = "/nilai/create?siswa=" + value;
		});
	</script>
@endpush
