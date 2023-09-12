@extends('setupWeb')

@section('main')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="p-0 col-md-10 d-flex justify-content-between align-items-center">
            <h2 class="putih" id="judul" >Kas Masuk</h2>
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
      <div id="data${data.id}" data-bs-toggle="modal" data-bs-target="#createModal" data-id="${data.id}" data-type="show" class="data rounded col-md-10 my-1 bg-putih p-2 d-flex justify-content-between align-items-center">
        <div class="">
          <h4 data-bs-toggle="modal" data-bs-target="#createModal" data-id="${data.id}" data-type="show" data-edit="namaAnggota" class="fieldEdit" >${data.namaAnggota}</h4> 
          <h6 data-bs-toggle="modal" data-bs-target="#createModal" data-id="${data.id}" data-type="show" data-edit="uang" class="fieldEdit text-success fw-bold p-0" >${data.uang}</h6> 
        </div>
        <div>
            <button type="button"  data-bs-toggle="modal" data-bs-target="#createModal" data-type="edit" data-select="${data.anggota_id}" class="editButton btn btn-primary fw-bold" data-id="${data.id}" ><i data-id="${data.id}" data-type="edit" data-select="${data.anggota_id}" data-bs-toggle="modal" data-bs-target="#createModal" class="editButton bi bi-pencil-square"></i></button>
            <button type="button"  data-bs-toggle="modal" data-bs-target="#createModal" data-type="delete" class="btn btn-danger fw-bold" data-id="${data.id}" ><i data-id="${data.id}" data-type="delete" data-bs-toggle="modal" data-bs-target="#createModal" class="bi bi-trash"></i></button>
        </div>
      </div> 
    </div>
</div>

<!-- Modal -->
<div class="modal fade border-none" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-body" >
          <form id="formCreate" data-method="POST" >
            @csrf
            <div class="bodyModal">
              <h4 class="hitam-commit text-center ">Tambah Kas Masuk</h4>
              <div class="mb-3 mt-2">
                <label for="anggota" class="form-label" >Anggota</label>
                <select class="form-select" name="anggota_id" aria-label="Default select example" required>
                    <option value>Pilih Anggota</option>
                    @foreach ($anggotas as $anggota)
                        <option value="{{ $anggota->id }}">{{ $anggota->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="mb-3 mt-2">
                <label for="uang" class="form-label" >Uang</label>
                <input type="number" max="1000000" required class="form-control" id="uang" name="uang" >
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