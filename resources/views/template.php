@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    @section('halaman', 'Data Template')

    <div class="row">

        <div class="col-12 col-xl-12 stretch-card">

            <div class="row flex-grow">

                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Warga Pesantren Jawa Barat</h6>
                                <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="download-cloud" class="icon-sm mr-2"></i> <span
                                                class="">Download</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">200</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+3.3%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Warga Pesantren Jateng & Jatim</h6>
                                <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="download-cloud" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">500</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>-2.8%</span>
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Warga Sekolah Luar Jawa</h6>
                                <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="#"><i
                                                data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">100</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+2.8%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
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
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Masukan Alamat Baru</h4>
                        <button class="btn btn-primary fas fa-arrow-down" type="button" data-toggle="collapse"
                                data-target="#formSek" aria-expanded="false" aria-controls="formSek">
                        </button>
                    </div>
                    <form class="collapse show" id="formSek" method="POST" action="{{ route('alamat.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="alamat">Alamat Jalan</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                   name="alamat"
                                   placeholder="Nama Jalan dan RT RW" value="{{ old('alamat') }}" autocomplete>

                            @error('alamat')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                   id="provinsi"
                                   name="provinsi"
                                   placeholder="Masukan nama provinsi" value="{{ old('kelurahan') }}" autocomplete>

                            @error('provinsi')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kotakabupaten">Kota/Kabupaten</label>
                            <input type="text" class="form-control @error('kotakabupaten') is-invalid @enderror"
                                   id="kotakabupaten"
                                   name="kotakabupaten"
                                   placeholder="Kota Bandung/Kabupaten Bandung" value="{{ old('kotakabupaten') }}"
                                   autocomplete>

                            @error('kotakabupaten')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                   id="kecamatan" name="kecamatan"
                                   placeholder="Masukan nama kecamatan" value="{{ old('kecamatan') }}" autocomplete>

                            @error('kecamatan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                   id="kelurahan"
                                   name="kelurahan"
                                   placeholder="Masukan nama kelurahan" value="{{ old('kelurahan') }}" autocomplete>

                            @error('kelurahan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_pos">Kode POS</label>
                            <input type="number" class="form-control @error('kode_pos') is-invalid @enderror"
                                   id="kode_pos"
                                   name="kode_pos"
                                   placeholder="Masukan kode pos" value="{{ old('kode_pos') }}" autocomplete>

                            @error('kode_pos')
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

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Kumpulan Data Alamat Warga Pesantren</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped dataTable">
                            <thead>
                            <tr>
                                <th>Alamat</th>
                                <th>Provinsi</th>
                                <th>Kota/Kabupaten</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Kode POS</th>
                                <th class="text-right">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->provinsi }}</td>
                                    <td>{{ $d->kotakabupaten }}</td>
                                    <td>{{ $d->kecamatan }}</td>
                                    <td>{{ $d->kelurahan }}</td>
                                    <td>{{ $d->kode_pos }}</td>
                                    <td class="text-right">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning btn-modal"
                                                    data_id="{{ $d->id }}" data_alamat="{{ $d->alamat }}"
                                                    data_provinsi="{{ $d->provinsi }}"
                                                    data_kotakabupaten="{{ $d->kotakabupaten }}"
                                                    data_kecamatan="{{ $d->kecamatan }}"
                                                    data_kelurahan="{{ $d->kelurahan }}" data_pos="{{ $d->kode_pos }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-hapus"
                                                    data_id="{{ $d->id }}" data_token="{{ csrf_token() }}"> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- row -->

    {{-- Modal --}}
    <div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         data-backdrop="static"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form-edit" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="alamat-edit">Alamat Jalan</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                   id="alamat-edit"
                                   name="alamat"
                                   placeholder="Nama Jalan dan RT RW" value="{{ old('alamat') }}" autocomplete>

                            @error('alamat')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="provinsi-edit">Provinsi</label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                   id="provinsi-edit"
                                   name="provinsi"
                                   placeholder="Masukan nama provinsi" value="{{ old('kelurahan') }}" autocomplete>

                            @error('provinsi')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kotakabupaten-edit">Kota/Kabupaten</label>
                            <input type="text" class="form-control @error('kotakabupaten') is-invalid @enderror"
                                   id="kotakabupaten-edit"
                                   name="kotakabupaten"
                                   placeholder="Kota Bandung/Kabupaten Bandung" value="{{ old('kotakabupaten') }}"
                                   autocomplete>

                            @error('kotakabupaten')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kecamatan-edit">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                   id="kecamatan-edit" name="kecamatan"
                                   placeholder="Masukan nama kecamatan" value="{{ old('kecamatan') }}" autocomplete>

                            @error('kecamatan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelurahan-edit">Kelurahan</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                   id="kelurahan-edit"
                                   name="kelurahan"
                                   placeholder="Masukan nama kelurahan" value="{{ old('kelurahan') }}" autocomplete>

                            @error('kelurahan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_pos-edit">Kode POS</label>
                            <input type="number" class="form-control @error('kode_pos') is-invalid @enderror"
                                   id="kode_pos-edit"
                                   name="kode_pos"
                                   placeholder="Masukan kode pos" value="{{ old('kode_pos') }}" autocomplete>

                            @error('kode_pos')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>

    <script type="text/javascript">
        $(".btn-modal").on('click', function () {
            // Ambil semua attribute
            var id = $(this).attr('data_id');
            var alamat = $(this).attr('data_alamat');
            var provinsi = $(this).attr('data_provinsi');
            var kotakabupaten = $(this).attr('data_kotakabupaten');
            var kecamatan = $(this).attr('data_kecamatan');
            var kelurahan = $(this).attr('data_kelurahan');
            var kode_pos = $(this).attr('data_pos');

            // Ubah semua inputan didalam modal mengikuti sumbernya
            $("#alamat-edit").val(alamat);
            $("#provinsi-edit").val(provinsi);
            $("#kotakabupaten-edit").val(kotakabupaten);
            $("#kecamatan-edit").val(kecamatan);
            $("#kelurahan-edit").val(kelurahan);
            $("#kode_pos-edit").val(kode_pos);

            $("#form-edit").attr("action", "http://localhost:8000/alamat/" + id);

            $("#modal-edit").modal('show')
        });

        $('.btn-hapus').click(function () {
            // Ambil data yang diperlukan
            var id = $(this).data("id")
            var token = $(this).data("token")

            var url = "alamat/" + id;
            var form = $('<form action="' + url + '" method="POST" style="display: none;">' +
                '<input type="hidden" name="_token" value="' + token + '" readonly />' +
                '<input type="hidden" name="_method" value="DELETE" readonly />' +
                '<input type="hidden" name="id" value="' + id + '" readonly />');
            $("body").append(form);
            form.submit();
        });
    </script>
@endpush
