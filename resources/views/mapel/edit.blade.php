@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    @section('halaman', 'Edit Data Mata Pelajaran')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Data Mata Pelajaran</h4>
                    </div>
                    <form method="POST" action="{{ route('mapel.update', ['mapel' => $data->id]) }}">
                        @csrf
						@method('patch')
                        <div class="form-group">
                            <label for="nama">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                   name="nama"
                                   placeholder="Masukan nama mata pelajaran" value="{{ $data->nama }}" autocomplete>

                            @error('nama')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
						<div class="form-group">
                            <label for="kelas_id">Kelas</label>
							<select class="select2-single form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id">
								@foreach($kelas as $d)
									<option value="{{ $d->id }}" @if($data->kelas_id == $d->id) selected @endif>{{ $d->kelas }}</option>
								@endforeach
							</select>

                            @error('kelas_id')
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
@endpush
