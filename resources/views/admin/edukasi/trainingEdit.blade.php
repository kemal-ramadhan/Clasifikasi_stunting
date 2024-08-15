@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/training">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$training->umur}}</a></li>
    </ol>

    <div class="card mt-5 col-sm-6">
        <div class="card-body">
            <form action="/update_training" method="post">
                @csrf
                <input type="hidden" name="idTraining" value="{{$training->id}}">
              <div class="row">
                <div class="col-sm-12 mb-3">
                    <label for="usia" class="form-label">Usia (Bulan)</label>
                    <input type="text" class="form-control" id="usia" name="usia" placeholder="Usia (bulan)" value="{{$training->umur}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="bb" class="form-label">Berat Badan</label>
                    <input type="text" class="form-control" id="bb" name="bb" placeholder="Berat Badan" value="{{$training->berat_badan}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="tb" class="form-label">Tinggi Badan</label>
                    <input type="text" class="form-control" id="tb" name="tb" placeholder="Tinggi Badan" value="{{$training->tinggi_badan}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="lt" class="form-label">Lingkat Kepala</label>
                    <input type="text" class="form-control" id="lt" name="la" placeholder="Lingkar Kepala" value="{{$training->lingkar_atas}}">
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="nama" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$training->status}}" selected>{{$training->status}}</option>
                        <option value="absence">absence / Tidak Stunting</option>
                        <option value="presence">presence / Stunting</option>
                    </select>
                </div>
                <div class="col-sm-12 mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Perbaharui Data</button>
                </div>
              </div>
            </form>
        </div>
    </div>
@endsection