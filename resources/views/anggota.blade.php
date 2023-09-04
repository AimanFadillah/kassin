@extends('setupWeb')

@section('main')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="p-0 col-md-10 d-flex justify-content-between align-items-center">
            <h2 class="putih">Anggota</h2>
            <div>   
                <button type="button" class="btn btn-light fw-bold"><i class="bi bi-search"></i> Cari</button>
                <button type="button" class="btn btn-light fw-bold" data-bs-toggle="modal" data-bs-target="#createModal" ><i class="bi bi-plus-lg"></i> Tambah</button>
            </div>
        </div>
        <div class="rounded col-md-10 my-1 bg-putih p-2 d-flex justify-content-between align-items-center">
            <h4>test</h4>
            <div>
                <button type="button" class="btn btn-primary fw-bold"><i class="bi bi-pencil-square"></i></button>
                <button type="button" class="btn btn-danger fw-bold"><i class="bi bi-trash"></i></button>
            </div>
        </div>
        <div class="rounded col-md-10 my-1 bg-putih p-2">
            <h4>test</h4>
        </div>
        <div class="rounded col-md-10 my-1 bg-putih p-2">
            <h4>test</h4>
        </div>
        <div class="rounded col-md-10 my-1 bg-putih p-2">
            <h4>test</h4>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection 