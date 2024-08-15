@extends('admin.template.template')

@section('content')
    <!-- Page Heading -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/reportAnak/{{$anak->id}}">{{$title}}</a></li>
        <li class="breadcrumb-item"><a>{{$anak->nama}}</a></li>
    </ol>

    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <b>Biodata Anak</b>
                    <hr>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">: {{$anak->nik}}</th>
                          </tr>
                          <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">: {{$anak->nama}}</th>
                          </tr>
                          <tr>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">: {{$anak->jk}}</th>
                          </tr>
                          <tr>
                            <th scope="col">Tempat, Tanggal Lahir</th>
                            <th scope="col">: {{$anak->tempat_lahir}}, {{$anak->tanggal_lahir}}</th>
                          </tr>
                          <tr>
                            <th scope="col">Usia</th>
                            <th scope="col">: {{date_diff(date_create($anak->tanggal_lahir), date_create('today'))->y}}</th>
                          </tr>
                          <tr>
                            <th scope="col">Nama Orang Tua</th>
                            <th scope="col">: {{$anak->wali}}</th>
                          </tr>
                          <tr>
                            <th scope="col">Keterangan</th>
                            <th scope="col">: {{$anak->keterangan}}</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card mt-3 col-sm-12 shadow-sm">
                <div class="card-body">
                <form action="/update_pemeriksaan" method="post">
                        @csrf
                        <input type="hidden" name="idPemriksaan" value="{{$hasil->id}}">
                        <input type="hidden" name="idAnak" value="{{$anak->id}}">
                        <b>Hasil Pemeriksaan</b>
                    <hr>
                    <div class="row">
                        <div class="mb-3 col-sm-4">
                            <label for="bb" class="form-label">Berat Badan</label>
                            <input type="number" class="form-control" id="bb" placeholder="Berat Badan" name="bb" value="{{$hasil->berat_badan}}">
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="tb" class="form-label">Tinggi Badan</label>
                            <input type="number" class="form-control" id="tb" placeholder="Tinggi Badan" name="tb" value="{{$hasil->tinggi_badan}}">
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="lk" class="form-label">Lingkar Kepala</label>
                            <input type="number" class="form-control" id="lk" placeholder="Tinggi Badan" name="lk" value="{{$hasil->lingkar_kepala}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-4">
                            <label for="vitamin" class="form-label">Vitamin</label>
                            <input type="text" class="form-control" id="vitamin" placeholder="Vitamin" name="vitamin" value="{{$hasil->vitamin}}">
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="imunisasi" class="form-label">Imunisasi</label>
                            <input type="text" class="form-control" id="imunisasi" placeholder="Imunisasi" name="imunisasi" value="{{$hasil->imunisasi}}">
                        </div>
                        <div class="mb-3 col-sm-4">
                            <label for="stunting" class="form-label">Status Stunting</label>
                            <select class="form-select" aria-label="Default select example" name="stunting" required>
                                <option value="{{$hasil->stunting}}" selected>{{$hasil->stunting}}</option>
                                <option value="positive">Positive</option>
                                <option value="negative">Negative</option>
                            </select>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label for="lk" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">{{$hasil->keterangan}}</textarea>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto mt-3">
                        <button class="btn btn-primary" type="submit">Simpan Data & Perbaharui</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if ($predicted == 'absence')
                        <div class="card py-3">
                            <div class="card-body text-center" style="line-height: 20px;">
                                <img src="{{asset('assets/images/icons/child.png')}}" alt="home" style="width: 50%;">
                                <h4 class="fw-bold">Si Paling Sehat!</h4>
                                <b>Hallo! Bunda {{$anak->wali}}!</b>
                                <p>Tumbuh tinggi dan sehat seperti seharusnya, tidak ada kekhawatiran tentang stunting.</p>
                                <span class="alert alert-info">Hasil Sistem Mengatakan : Tidak Beresiko Stunting</span>
                            </div>
                        </div>
                        @else
                        <div class="card py-3">
                            <div class="card-body text-center" style="line-height: 20px;">
                                <img src="{{asset('assets/images/icons/stunting.png')}}" alt="home" style="width: 50%;">
                                <h4 class="fw-bold">Ayo Ke Puskesmas</h4>
                                <b>Hallo! Bunda {{$anak->wali}}!</b>
                                <p>Jangan khawatir bersama-sama, kita akan membuat perubahan positif untuk menghentikan stunting dan memastikan kamu tumbuh dengan baik.</p>
                                <span class="alert alert-danger">Hasil Sistem Mengatakan : Beresiko Stunting</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body">
                            {!! $chartStunting->container() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ $chartStunting->cdn() }}"></script>
    {{ $chartStunting->script() }}
@endsection