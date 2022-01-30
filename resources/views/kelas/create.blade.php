@extends('layout.master')

@push('plugin-styles')
@endpush

@section('halaman', 'Tambah Data Kelas')
@section('content')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Masukan Data Kelas Baru</h4>
                    </div>
                    <form method="POST" action="{{ route('kelas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="number" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                   name="kelas"
                                   placeholder="Masukan kelas" value="{{ old('kelas') }}" autocomplete>

                            @error('kelas')
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
