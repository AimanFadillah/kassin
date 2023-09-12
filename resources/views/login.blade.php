@extends('setupWeb')

@section('main')

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-4 rounded p-2 pt-4 pb-3 bg-putih bayangan ">
            <h1 class="fw-bold text-center fs-2 d-lg-block d-none  " >Login Kassin</h1>
            <h1 class="fw-bold text-center d-lg-none d-block fs-1 " >Login Kassin</h1>
            <div class="d-flex justify-content-center align-items-center " style="flex-direction: column" >
                <img src="/img/auth.png" width="100%" style="margin-top: -50px" alt="gambar orang login">
                <a href="/google" style="width: 100%;" class="bg-biru-commit rounded button bayangan py-2 fs-5 text-white fw-bold"  >Masuk</a>
            </div>
        </div>
    </div>
</div>  
     
@endsection 