@extends('layout.master')

@push('plugin-styles')
@endpush

@section('halaman', 'Tambah Data Siswa')
@section('content')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Masukan Data Siswa Baru</h4>
                    </div>
                    <form method="POST" action="{{ route('siswa.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                   name="nama"
                                   placeholder="Masukan nama lengkap siswa" value="{{ old('nama') }}" autocomplete>

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
                                   placeholder="Masukan nomor NIS" value="{{ old('nis') }}" autocomplete>

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
                                   placeholder="Masukan nomor NISN" value="{{ old('nisn') }}"
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
							<input type="file" class="border myDropify" name="foto" accept="image/*">

                            @error('foto')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alanat Lengkap</label>
							<textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukan alamat lengkap siswa" name="alamat">{{ old('alamat') }}</textarea>

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
									<option value="{{ $d->id }}" @if((int) old('kelas_id') === (int) $d->id) selected @endif>{{ $d->kelas }}</option>
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
@endpush

@push('custom-scripts')
@endpush
