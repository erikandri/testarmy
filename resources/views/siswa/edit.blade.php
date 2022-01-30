@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @section('halaman', 'Edit Data Siswa')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Data Siswa</h4>
                    </div>
                    <form method="POST" action="{{ route('siswa.update', ['siswa' => $data->id]) }}" enctype="multipart/form-data">
                        @csrf
						@method('patch')
                        <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                   name="nama"
                                   placeholder="Masukan nama lengkap siswa" value="{{ $data->nama }}" autocomplete>

                            @error('nama')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nis">Nomor NIS</label>
                            <input type="number" class="form-control @error('nis') is-invalid @enderror"
                                   id="nis"
                                   name="nis"
                                   placeholder="Masukan nomor NIS" value="{{ $data->nis }}" autocomplete>

                            @error('nis')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nisn">Nomor NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                   id="nisn"
                                   name="nisn"
                                   placeholder="Masukan nomor NISN" value="{{ $data->nisn }}"
                                   autocomplete>

                            @error('nisn')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Siswa</label>
							<input type="hidden" class="@error('foto') is-invalid @enderror">
							<input type="file" class="border myDropify " name="foto" accept="image/*" value="{{ $data->foto }}">

                            @error('foto')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alanat Lengkap</label>
							<textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" maxlength="100" rows="3" placeholder="Masukan alamat lengkap siswa" name="alamat">{{ $data->alamat }}</textarea>

                            @error('alamat')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
							<select class="select2-single form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id">
								@foreach($kelas as $d)
									<option value="{{ $d->id }}" @if((int)$d->id === (int)$data->kelas_id) selected @endif>{{ $d->kelas }}</option>
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

    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush

@push('custom-scripts')
@endpush
