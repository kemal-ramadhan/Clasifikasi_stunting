@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/ref-kb">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$kb->nama_kb}}</a></li>
      </ol>

    <form action="/u_kb" method="post">
        @csrf
    <div class="card col-sm-6 mt-3 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <label for="kb" class="form-label">Nama Pill Kabe</label>
                    <input type="text" class="form-control" id="kb" name="kb" value="{{$kb->nama_kb}}">
                    <input type="hidden" name="idKb" value="{{$kb->id}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">{{$kb->keterangan}}</textarea>
                  </div>
                <div class="col-sm-12 mb-3">
                    <label for="nama" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$kb->status}}" selected>{{$kb->status}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Perbaharui Data</button>
            </div>
        </div>
    </div>
</form>
@endsection