@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pr-md-0">
                            <div class="auth-left-wrapper"
                                 style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

                            </div>
                        </div>
                        <div class="col-md-8 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Erik<span>Web</span></a>
                                <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your
                                    account.</h5>
                                <form method="POST" action="{{ route('login.auth') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" placeholder="Masukan email"
                                               value="{{ old('email') || !empty(session('email')) ? session('email') : '' }}" autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" value="{{ !empty(session('password')) ? session('password') : '' }}"
                                               placeholder="Masukan password" autocomplete="password" autofocus>

                                        @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label">
											<input type="checkbox" id="checkbox1" class="form-check-input">
											  Remember me
										</label>
									</div>
									@error('remember')
									<span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
									@enderror
									<input type="hidden" id="checkbox-value" name="remember" value="false" readonly>
                                    @error('email')
                                    <span>
                                        <small
                                            class="text-danger">Email atau Password yang anda masukan salah.</small>
                                    </span>
                                    @enderror
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Login</button>
										<a href="{{ route('register.index') }}" class="btn btn-primary mr-2 mb-2 mb-md-0">Daftar Akun</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('custom-scripts')
	<script>
		$("#checkbox1").on('change', function() {
			if ($(this).is(':checked')) {
				$(this).attr('value', 'true');
			} else {
				$(this).attr('value', 'false');
			}
			
			$('#checkbox-value').val($('#checkbox1').val());
		});
	</script>
@endpush