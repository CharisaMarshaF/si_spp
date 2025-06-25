<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active ">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>                                                                       

                {{-- Menu untuk SISWA --}}
                @if(Auth::user()->level === 'siswa')                                                                                                

                {{-- Menu untuk ADMIN --}}
                @if(Auth::user()->level === 'admin')
                <li class="sidebar-title">Master</li>
                <li class="sidebar-item">
                    <a href="{{ route('kelas.index') }}" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Kelas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('spp.index') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>SPP</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('petugas.index') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Petugas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('siswa.index') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                @endif

                {{-- Menu untuk ADMIN dan PETUGAS --}}
                @if(Auth::user()->level === 'admin' || Auth::user()->level === 'petugas')
                <li class="sidebar-title">Pembayaran</li>
                <li class="sidebar-item">
                    <a href="{{ route('pembayaran.index') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Pembayaran</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('pembayaran.riwayat') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Riwayat</span>
                    </a>
                </li>
                @endif

                {{-- Menu khusus SISWA --}}
                @if(Auth::user()->level === 'siswa')
                <li class="sidebar-title">Pembayaran</li>
                <li class="sidebar-item">
                    <a href="{{ route('pembayaran.siswa.riwayat') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Riwayat Pembayaran Saya</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>