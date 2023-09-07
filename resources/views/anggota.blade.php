@extends('setupWeb')

@section('main')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="p-0 col-md-10 d-flex justify-content-between align-items-center">
            <h2 class="putih">Anggota</h2>
            <div>   
                <button type="button" id="buttonCari" class="btn btn-light fw-bold"><i class="bi bi-search"></i> Cari</button>
                <button type="button" class="btn btn-light fw-bold" data-bs-toggle="modal" data-bs-target="#createModal" data-type="create" ><i class="bi bi-plus-lg" data-bs-toggle="modal" data-bs-target="#createModal" data-type="create"></i> Tambah</button>
            </div>
        </div>
        <div class="col-md-10 p-0" id="cari" style="display: none">
          <form id="formCari">
            <input type="search" id="inputCari" name="cari" class="form-control my-1" placeholder="Cari Anggota..." >
          </form>
        </div>
    </div>
    <div class="row justify-content-center" id="containerData" >

    </div>
</div>

<!-- Modal -->
<div class="modal fade border-none" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body" >
          <form id="formCreate" data-method="POST" >
            @csrf
            <div class="bodyModal">
              <h4 class="hitam-commit text-center ">Tambah Anggota</h4>
              <div class="mb-3 mt-2">
                <label for="name" class="form-label" >Nama</label>
                <input type="text" required class="form-control" id="name" name="name" >
              </div>
              <div class="d-flex justify-content-center">
                <button id="buttonSubmit" class="btn btn-success" style="width: 100%" >Buat</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer d-none">
          <button type="button" id="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

 

<script src="/js/sistem.js"></script>
@endsection 