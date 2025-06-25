
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>
    @include('layouts.css')

</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            <header class="mb-3 d-flex justify-content-between align-items-center">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            
                <div></div> {{-- Spacer untuk bagian tengah kosong --}}
            
                <!-- Profil User di pojok kanan -->
                <div class="dropdown ms-auto me-4">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- <span class="me-2 text-dark">{{ Auth::user()-> }}</span> --}}
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>
            

            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                    
                </section>
            </div>

            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.js')
</body>

</html>