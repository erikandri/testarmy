@extends('layout.master')

@push('plugin-styles')
@endpush

@section('halaman', 'Dashboard')
@section('content')

    <div class="row">

        <div class="col-12 col-xl-12 stretch-card">

            <div class="row flex-grow">

                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Jumlah Siswa</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $siswa }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Jumlah Mata Pelajaran</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $mapel }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Jumlah Guru</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $guru }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<hr class="mt-2">

				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
					  <div class="row no-gutters">
						<div class="col-md-4 d-flex align-items-center justify-content-center">
						  <span class="fa fa-3x fas fa-graduation-cap text-black"></span>
						</div>
						<div class="col">
						  <div class="card-body">
							<h5 class="card-title">Data Siswa</h5>
							<a href="{{ route('siswa.index') }}" class="card-link">Input Data Siswa</a>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
					  <div class="row no-gutters">
						<div class="col-md-4 d-flex align-items-center justify-content-center">
						  <span class="fa fa-3x fas fa-book text-black"></span>
						</div>
						<div class="col">
						  <div class="card-body">
							<h5 class="card-title">Data Mata Pelajaran</h5>
							<a href="{{ route('mapel.index') }}" class="card-link">Input Data Mata Pelajaran</a>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
					  <div class="row no-gutters">
						<div class="col-md-4 d-flex align-items-center justify-content-center">
						  <span class="fa fa-3x fas fa-tasks text-black"></span>
						</div>
						<div class="col">
						  <div class="card-body">
							<h5 class="card-title">Data Nilai</h5>
							<a href="{{ route('nilai.index') }}" class="card-link">Input Data Nilai</a>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
					  <div class="row no-gutters">
						<div class="col-md-4 d-flex align-items-center justify-content-center">
						  <span class="fa fa-3x fas fa-school text-black"></span>
						</div>
						<div class="col">
						  <div class="card-body">
							<h5 class="card-title">Data Kelas</h5>
							<a href="{{ route('kelas.index') }}" class="card-link">Input Data Kelas</a>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="col-md-4 grid-margin stretch-card">
					<div class="card">
					  <div class="row no-gutters">
						<div class="col-md-4 d-flex align-items-center justify-content-center">
						  <span class="fa fa-3x fas fa-star text-black"></span>
						</div>
						<div class="col">
						  <div class="card-body">
							<h5 class="card-title">Data Ranking</h5>
							<a href="{{ route('ranking') }}" class="card-link">Lihat Data Ranking</a>
						  </div>
						</div>
					  </div>
					</div>
				</div>

            </div>

        </div>

    </div> <!-- row -->

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
