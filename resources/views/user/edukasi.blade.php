@extends('user.template')

@section('content')
<div class="container mt-5">
    <h3 class="fw-bold">Edukasi Kesehatan</h3>
    <div class="row">
    @forelse ($edukasis as $edukasi)
        <div class="col-sm-4 mb-3">
            <div class="card" style="width: 100%;">
                <iframe width="100%" height="100%" src="{{$edukasi->link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <div class="card-body">
                    <h5 class="card-title">{{$edukasi->judul}}</h5>
                    <p class="card-text">{{$edukasi->keterangan}}</p>
                    <div class="card-footer">
                        <small class="text-body-secondary">{{$edukasi->updated_at}}</small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-danger text-center col-sm-12" role="alert">
            Belum ada vidio edukasi yang dibagikan!
        </div>
        @endforelse
    </div>
</div>
@endsection