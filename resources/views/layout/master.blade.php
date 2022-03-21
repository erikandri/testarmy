<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Erik Web</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="Erik Andri Budiman, Cyberarmy">
    <meta name="description" content="Program Input Nilai - Cyberarmy">
    <meta name="author" content="Erik Andri Budiman">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/fonts/fontawesome/css/all.min.css') }}" rel="stylesheet"/>
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
    <style>
        .select2-container {
            width: 100% !important;
            padding: 0;
        }
		
		/*
		*
		* ==========================================
		* CUSTOM UTIL CLASSES
		* ==========================================
		*
		*/

		hr.dashed {
			border-top: 2px dashed #000;
		}

		hr.dotted {
			border-top: 2px dotted #000;
		}

		hr.solid {
			border-top: 2px solid black;
		}


		hr.hr-text {
		  position: relative;
			border: none;
			height: 1px;
			background: #000;
		}

		hr.hr-text::before {
			content: attr(data-content);
			display: inline-block;
			background: #fff;
			font-weight: bold;
			font-size: 0.85rem;
			color: #000;
			border-radius: 30rem;
			padding: 0.2rem 2rem;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

    </style>
</head>
<body data-base-url="{{ url('/') }}">

<script src="{{ asset('assets/js/spinner.js') }}"></script>

<div class="main-wrapper" id="app">
    @include('layout.sidebar')
    <div class="page-wrapper">
        @include('layout.header')
        <div class="page-content">
            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                    <h4 class="mb-3 mb-md-0">@yield('halaman')</h4>
                </div>
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                    <div class="dashboardDate input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
                        <span class="input-group-addon bg-transparent">
                            <i class="fa fas fa-calendar text-primary"></i>
                        </span>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="dashboardTime input-group datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
                        <span class="input-group-addon bg-transparent">
                            <i class="fa fas fa-clock text-primary"></i>
                        </span>
                        <input type="text" id="realtimeIn" class="form-control" disabled>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        @include('layout.footer')
    </div>
</div>

<!-- base js -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- end common js -->

@stack('custom-scripts')
<script>
	$(document).ready(function() {
		var popOverSettings = {
			trigger: "focus",
			placement: "bottom",
			sanitize: false,
			html: true,
			animation: true,
			selector: "[data-toggle='popover']",
			container: "body",
			content: function () {
				return $("#data-content").html();
			}
		}
		$("body").popover(popOverSettings);
		
		$('.myDropify').dropify();	
	});
	
	if ($(".select2-single").length) {
		$(".select2-single").select2();
	}
	if ($(".select2-multiple").length) {
		$(".select2-multiple").select2();
	}
	
	// Dashbaord date start
	if ($('.dashboardDate').length) {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
		$('.dashboardDate').datepicker({
			format: "dd MM yyyy",
			todayHighlight: true,
			autoclose: true,
			language: 'id'
		});
		$('.dashboardDate').datepicker('setDate', today);
	}
	// Dashbaord date end

	// Dashboard realtime start
	var rtin = document.getElementById(('realtimeIn'));
	function realtime() {
		var d = new Date();
		var s = d.getSeconds();
		var m = d.getMinutes();
		var h = d.getHours();
		rtin.value = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
	}
	setInterval(realtime, 1000);
	// Dashboard realtime end
</script>
</body>
</html>
