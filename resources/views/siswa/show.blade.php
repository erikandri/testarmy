@extends('layout.master')

@push('plugin-styles')
@endpush

@section('halaman', 'Profil Siswa')
@section('content')

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex align-items-center justify-content-center my-3">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($data->foto) }}" alt="Foto profil siswa" width="50%">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Profil Siswa: {{ $data->nama }}</h5>
                            <table class="table table-borderless w-100">
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>: {{ $data->nama }}</td>
                                <tr>
                                <tr>
                                    <th>Nomor NIS</th>
                                    <td>: {{ $data->nis }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor NISN</th>
                                    <td>: {{ $data->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Lengkap</th>
                                    <td style="white-space:pre-wrap; word-wrap:break-word">: {{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Berada Di Kelas</th>
                                    <td>: {{ $data->kelas->kelas }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('siswa.download', ['siswa' => $data->id]) }}" class="card-link">Klik untuk mengunduh foto profil</a><br>
                            <div class="btn-group" role="group">
                                <a href="{{ route('siswa.index') }}" class="btn btn-primary">
                                    <i class="fa fas fa-arrow-left"></i> Kembali ke halaman siswa
                                </a>
                                <a href="{{ route('siswa.edit', ['siswa' => $data->id]) }}" class="btn btn-warning text-white">
                                    <i class="fa fas fa-pencil"></i> Edit Siswa Ini
                                </a>
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
    <script type="text/javascript">
        var tabel = $("#siswaTable");

        tabel.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data.siswa') }}",
            },
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'induk', name: 'induk', orderable: false, searchable: false},
                {data: 'alamat', name: 'alamat', orderable: false, searchable: false},
                {data: 'kelas', name: 'kelas', orderable: false, searchable: false},
                {data: 'foto', name: 'foto', orderable: false, searchable: false},
                {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            ],
            columnDefs: [
                {defaultContent: "-", targets: "_all"},
            ],
            language: {
                search: "Cari nama siswa"
            }
        });

        tabel.on('click', '.btn-edit', function () {
            // Ambi data yang diperlukan
            var id = $(this).data("id")
            window.location.href = "/siswa/" + id + "/edit"
        });

        tabel.on('click', '.btn-hapus', function () {
            // Ambil data yang diperlukan
            var id = $(this).data("id")
            var token = "{{ csrf_token() }}"

            var url = "siswa/" + id;
            var form = $('<form action="' + url + '" method="POST" style="display: none;">' +
                '<input type="hidden" name="_token" value="' + token + '" readonly />' +
                '<input type="hidden" name="_method" value="DELETE" readonly />' +
                '<input type="hidden" name="id" value="' + id + '" readonly />');
            $("body").append(form);
            form.submit();
        });
    </script>
@endpush
