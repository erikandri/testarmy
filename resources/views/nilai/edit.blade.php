@extends('layout.master')

@push('plugin-styles')
@endpush

@section('halaman', 'Edit Data Nilai')
@section('content')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Data Nilai</h4>
                    </div>
                    <form method="POST" action="{{ route('nilai.update', ['nilai' => $data->id]) }}">
                        @csrf
						@method('patch')
                        <div class="form-group">
                            <label for="siswa_id">Nama Siswa</label>
							<input id="siswa_id" class="form-control" value="{{ $data->siswa->nama }}" disabled>
                        </div>
						<div class="form-group">
                            <label for="mapel_id">Nama Mata Pelajaran</label>
							<input id="mapel_id" class="form-control" value="{{ $data->mapel->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ $data->nilai }}" autocomplete placeholder="Masukan nilai">

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

    </div>

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
