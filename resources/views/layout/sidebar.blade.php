<?php
use Symfony\Component\HttpFoundation\Request;
$request = Request();
?>

<style>
	li i.fa {
		width: 10%;
	}
</style>

<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Erik<span>Web</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">

            <li class="nav-item nav-category">
                <i class="fa fas fa-briefcase"></i> Utama
            </li>
            <li class="nav-item {{ $request->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fa fas fa-laptop-house"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
			
			<li class="nav-item nav-category">
                <i class="fa fas fa-university"></i> Manajemen
            </li>
			<li class="nav-item {{ $request->routeIs('siswa.*') ? 'active' : '' }}">
				<a href="{{ route('siswa.index') }}" class="nav-link">
					<i class="fa fas fa-users"></i>
					<span class="link-title">Data Siswa</span>
				</a>
			</li>
			<li class="nav-item {{ $request->routeIs('kelas.*') ? 'active' : '' }}">
				<a href="{{ route('kelas.index') }}" class="nav-link">
					<i class="fa fas fa-school"></i>
					<span class="link-title">Data Kelas</span>
				</a>
			</li>

            <li class="nav-item nav-category">
                <i class="fa fas fa-chalkboard"></i> Proses KBM
            </li>
			<li class="nav-item {{ $request->routeIs('mapel.*') ? 'active' : '' }}">
				<a href="{{ route('mapel.index') }}" class="nav-link">
					<i class="fa fas fa-book"></i>
					<span class="link-title">Mata Pelajaran</span>
				</a>
			</li>
			<li class="nav-item {{ $request->routeIs('nilai.*') ? 'active' : '' }}">
				<a href="{{ route('nilai.index') }}" class="nav-link">
					<i class="fa fas fa-tasks"></i>
					<span class="link-title">Data Nilai</span>
				</a>
			</li>
			<li class="nav-item {{ $request->routeIs('ranking') ? 'active' : '' }}">
				<a href="{{ route('ranking') }}" class="nav-link">
					<i class="fa fas fa-star"></i>
					<span class="link-title">Data Ranking</span>
				</a>
			</li>
        </ul>
    </div>
</nav>
