@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    @section('halaman', 'Edit Data Kelas')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Data Kelas</h4>
                    </div>
                    <form method="POST" action="{{ route('kelas.update', ['kela' => $data->id]) }}">
                        @csrf
						@method('patch')
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="number" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                   name="kelas"
                                   placeholder="Masukan kelas" value="{{ $data->kelas }}" autocomplete>

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

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
