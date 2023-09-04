@extends('setupWeb')

@section('main')

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-5 rounded p-2 pt-4 pb-3 bg-putih bayangan ">
            <h1 class="fw-bold text-center fs-2 biru-commit" >Selamat Datang Di Kassin</h1>
            <div class="d-flex justify-content-center align-items-center " style="flex-direction: column" >
                <img src="/img/auth.png" width="75%" alt="gambar orang login">
                <a href="/google" style="width: 100%;" class="bg-biru-commit rounded button bayangan py-2 fs-5 text-white fw-bold"  >Masuk</a>
            </div>
        </div>
    </div>
</div>  
     
@endsection 