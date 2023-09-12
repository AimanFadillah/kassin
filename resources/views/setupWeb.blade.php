<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" > --}}
    <title>Kassin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        @font-face {
            font-family: 'satoshi';
            src: url('/font/Satoshi-Variable.ttf')
        }

        

        .bayangan { 
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .biru-commit {
            color: #3568FF;
        }

        .hitam-commit {
          color: #14171C;
        }

        .putih {
          color: #ffffff
        }

        .bg-hitam-commit {
          background-color: #14171C;
        }

        .bg-biru-commit {
            background-color: #3568FF;
        }

        .bg-putih {
            background-color: #ffffff;
        }

        .button {
            border: none;
            text-align: center;
            text-decoration: none;
        }

        *{
            font-family: 'satoshi', sans-serif;
        }

        .loading-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Latar belakang semi-transparan */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999; /* Mengatur lapisan tampilan tinggi agar tampilan loading muncul di atas elemen lain */
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #14171C;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 0.5s linear infinite; /* Animasi putaran */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>  
    <script src="/js/global.js" ></script>
</head>
  <body class="bg-hitam-commit" >
    <div id="loadingScreen" class="loading-screen" style="display: none">
      <div class="spinner"></div>
    </div>
    <nav class="navbar bg-body-tertiary bg-putih fixed-top {{ Request::is("login") ? "d-none" : ""}}">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold hitam-commit fs-3" href="/">Kassin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title fs-3 hitam-commit" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link hitam-commit fw-bold" aria-current="page" href="/"><i class="bi bi-house-door-fill"></i> Beranda</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link hitam-commit fw-bold" href="/kas-masuk"><i class="bi bi-graph-up-arrow"></i> Kas Masuk</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link hitam-commit fw-bold" href="#"><i class="bi bi-graph-down-arrow"></i> Kas Keluar</a>
                  </li>
                <li class="nav-item ">
                    <a class="nav-link hitam-commit fw-bold" href="/anggota"><i class="bi bi-people-fill"></i> Anggota</a>
                  </li>
                <li class="nav-item ">
                    <a class="nav-link hitam-commit fw-bold" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
    
    <div style="margin-top: 80px" class="container {{ Request::is("login") ? "mt-5" : ""}}">
        @yield('main')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>