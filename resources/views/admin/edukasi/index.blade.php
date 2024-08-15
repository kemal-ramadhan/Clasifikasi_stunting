@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/edukasi">{{$title}}</a></li>
    </ol>

    <div class="card mt-5 mb-3">
        <div class="card-body d-flex flex-row-reverse">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Vidio Edukasi</button>
        </div>
    </div>

    @forelse ($edukasis as $edukasi)
    <div class="card mb-3" style="width: 100%">
        <div class="row g-0">
          <div class="col-sm-5">
            <iframe width="100%" height="100%" src="{{$edukasi->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <div class="col-sm-7">
            <div class="card-body">
                <h5 class="card-title">{{$edukasi->judul}}</h5>
                <p class="card-text">{{$edukasi->keterangan}}</p>
              <p class="card-text"><small class="text-body-secondary">{{$edukasi->updated_at}}</small></p>
              <div class="d-flex">
                <a href="/del_edukasi/{{$edukasi->id}}" onclick="return confirm('Are You Sure You Want to Delete This?')" class="btn btn-danger">Hapus Vidio</a>
              </div>
            </div>
          </div>
        </div>
    </div>
    @empty
    <div class="alert alert-danger text-center" role="alert">
        Belum ada vidio edukasi yang dibagikan!
    </div>
    @endforelse
    
      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Vido Edukasi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/add_edukasi" method="POST">
          @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" placeholder="Judul" name="judul">
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link Youtube</label>
                <input type="text" class="form-control" id="link" placeholder="Link Youtube" name="link">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan dan Publish</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection