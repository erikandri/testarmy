@extends('layout.master')

@push('plugin-styles')
@endpush

@section('halaman', 'Data Mata Pelajaran')
@section('content')

    <div class="row">

        <div class="col-12 col-xl-12 stretch-card">

            <div class="row flex-grow">

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Jumlah Mata Pelajaran</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3>{{ $jumlah }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('controller_feedback'))
                    <div class="position-fixed top-1 right-0 p-3" style="z-index: 1; top: 1; right: 0;" id="flashToast">
                        <div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="5000">
                            <div class="toast-header">
                                <img src="https://assets.stickpng.com/images/58480e35cef1014c0b5e4920.png" height="20px"
                                     class="rounded mr-2" alt="Favicon">
                                <strong class="mr-2">Notifikasi Sistem</strong>
                                <small>just now</small>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                {{ session('controller_feedback') }}
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div> <!-- row -->

    <div class="row">

		<div class="col-md-12 grid-margin stretch-card">
			<a class="btn btn-primary" href="{{ route('mapel.create') }}">Tambah Mata Pelajaran Baru</a>
		</div>

        @if(session('relation'))
            <div class="col-md-12 grid-margin stretch-card mb-0">
                <small class="alert alert-danger">Peringatan: {{ session('relation') }}</small>
            </div>
        @endif

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Kumpulan Data Mata Pelajaran</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped w-100" id="mapelTable">
                            <thead>
                            <tr>
                                <th>Nama Mata Pelajaran</th>
								<th>Kelas</th>
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
@endpush

@push('custom-scripts')

    <script type="text/javascript">
        @if(session('controller_feedback'))
            $('#flashToast .toast').toast('show')
        @endif

        const tabel = $("#mapelTable");

        tabel.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data.mapel') }}",
            },
            columns: [
				{data: 'nama', name: 'nama'},
				{data: 'kelas', name: 'kelas', searchable: false},
                {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            ],
			order: [
				['1', 'asc']
			],
			columnDefs: [
                {defaultContent: "-", targets: "_all"}
            ],
			language: {
				search: "Cari nama mata pelajaran"
			}
        });

		tabel.on('click', '.btn-edit', function () {
			// Ambi data yang diperlukan
            const id = $(this).data("id")
			window.location.href = "/mapel/" + id + "/edit"
		});

        tabel.on('click', '.btn-hapus', function () {
            // Ambil data yang diperlukan
            const id = $(this).data("id")
            const token = "{{ csrf_token() }}"

            const url = "mapel/" + id;
            const form = $('<form action="' + url + '" method="POST" style="display: none;">' +
                '<input type="hidden" name="_token" value="' + token + '" readonly />' +
                '<input type="hidden" name="_method" value="DELETE" readonly />' +
                '<input type="hidden" name="id" value="' + id + '" readonly />');
            $("body").append(form);
            form.submit();
        });
    </script>
@endpush
