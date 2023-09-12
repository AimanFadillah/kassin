@extends('setupWeb')

@section('main')
    
    <div class="container">
       <div class="row">
            <div class="col-lg-3 my-2">
                <div class="bg-putih pt-4 pb-2 d-flex align-items-center rounded p-0 m-0" style="flex-direction: column" >
                    <h3 class="fw-bold d-lg-block d-none ld" >Tabungan</h3>
                    <h3 class="fw-bold d-lg-none d-block fs-1" >Tabungan</h3>
                    <img src="/img/tabungan.png" width="250" alt="tabungan">
                    <h4 class="biru-commit d-lg-block d-none fw-bold">{{ $tabungan }}</h4>
                    <h4 class="biru-commit fs-1 d-lg-none d-block fw-bold">{{ $tabungan }}</h4>
                    <a href="/kas-masuk" class="text-decoration-none text-center border-0 py-1 rounded bg-biru-commit fw-bold text-light" style="width: 95%"  >Lihat</a>
                </div>
            </div>
            <div class="col-lg-3 my-2">
                <div class="bg-putih pt-4 pb-2 d-flex align-items-center rounded p-0 m-0" style="flex-direction: column" >
                    <h3 class="fw-bold d-lg-block d-none d" >Kas Masuk</h3>
                    <h3 class="fw-bold d-lg-none d-block fs-1" >Kas Masuk</h3>
                    <img src="/img/kas.png" width="250" alt="tabungan">
                    <h4 class="biru-commit d-lg-block d-none text-success fw-bold">{{ $kas }}</h4>
                    <h4 class="biru-commit fs-1 d-lg-none d-block text-success fw-bold">{{ $kas }}</h4>
                    <a href="/kas-masuk" class="text-decoration-none text-center border-0 py-1 rounded bg-biru-commit fw-bold text-light" style="width: 95%"  >Lihat</a>
                </div>
            </div>
            <div class="col-lg-3 my-2">
                <div class="bg-putih pt-4 pb-2 d-flex align-items-center rounded p-0 m-0" style="flex-direction: column" >
                    <h3 class="fw-bold d-lg-block d-none " >Kas Keluar</h3>
                    <h3 class="fw-bold d-lg-none d-block fs-1" >Kas Keluar</h3>
                    <img src="/img/keluar.png" width="250" alt="tabungan">
                    <h4 class="biru-commit d-lg-block d-none text-danger fw-bold">{{ $keluar }}</h4>
                    <h4 class="biru-commit fs-1 d-lg-none d-block text-danger fw-bold">{{ $keluar }}</h4>
                    <a href="/kas-keluar" class="text-decoration-none text-center border-0 py-1 rounded bg-biru-commit fw-bold text-light" style="width: 95%"  >Lihat</a>
                </div>
            </div>
            <div class="col-lg-3 my-2">
                <div class="bg-putih pt-4 pb-2 d-flex align-items-center rounded p-0 m-0" style="flex-direction: column" >
                    <h3 class="fw-bold d-lg-block d-none old" >Anggota</h3>
                    <h3 class="fw-bold d-lg-none d-block fs-1" >Anggota</h3>
                    <img src="/img/anggota.png" width="250" alt="tabungan">
                    <h4 class="biru-commit d-lg-block d-none fw-bold">{{ $anggota }} Orang</h4>
                    <h4 class="biru-commit fs-1 d-lg-none d-block fw-bold">{{ $anggota }} Orang</h4>
                    <a href="/anggota" class="text-decoration-none text-center border-0 py-1 rounded bg-biru-commit fw-bold text-light" style="width: 95%"  >Lihat</a>
                </div>
            </div>
            
       </div>
    </div>

@endsection