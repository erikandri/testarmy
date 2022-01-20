@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    @section('halaman', 'Data Nilai')

    <div class="row">

        <div class="col-12 col-xl-12 stretch-card">

            <div class="row flex-grow">

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Jumlah Nilai</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3>{{ $jumlah }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
	
		<div class="col-md-12 grid-margin stretch-card">
			<a class="btn btn-primary" href="{{ route('nilai.create') }}">Tambah Nilai Baru</a>
		</div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Kumpulan Data Nilai</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped w-100" id="nilaiTable">
                            <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th class="text-right">AKSI</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->


@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script type="text/javascript">
		var tabel = $("#nilaiTable");
		
		tabel.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data.nilai') }}",
            },
            columns: [
                {data: 'siswa', name: 'siswa'},
                {data: 'mapel', name: 'mapel', orderable: false, searchable: false},
                {data: 'nilai', name: 'nilai', orderable: false, searchable: false},
                {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            ],
			columnDefs: [
                {defaultContent: "-", targets: "_all"}
            ],
			language: {
				search: "Cari nama siswa"
			}
        });
		
		tabel.on('click', '.btn-edit', function () {
			// Ambi data yang diperlukan
			var id = $(this).data("id")
			window.location.href = "/nilai/" + id + "/edit"
		});
			
        tabel.on('click', '.btn-hapus', function () {
            // Ambil data yang diperlukan
            var id = $(this).data("id")
            var token = "{{ csrf_token() }}"

            var url = "nilai/" + id;
            var form = $('<form action="' + url + '" method="POST" style="display: none;">' +
                '<input type="hidden" name="_token" value="' + token + '" readonly />' +
                '<input type="hidden" name="_method" value="DELETE" readonly />' +
                '<input type="hidden" name="id" value="' + id + '" readonly />');
            $("body").append(form);
            form.submit();
        });
    </script>
@endpush
