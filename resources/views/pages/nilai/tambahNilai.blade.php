@extends('layouts.admin');

@section('title')
    Dashboard | Nilai
@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Mapel</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Mapel</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Nilai {{$item->nama}}</h5>
              <a href="{{route('mapel.create')}}" class="btn btn-primary mb-2">
                Tambah Data <i class="fa-solid fa-plus ms-2"></i>
              </a>

              <!-- Table with stripped rows -->
              <table class="table table-striped" id="">
                <thead>
                  <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="10%">Nama</th>
                    <th scope="col" width="12%">Produk</th>
                    <th scope="col" width="10%">Nilai</th>
                    <th scope="col" width="20%">Deskripsi</th>
                    <th scope="col" width=15%>Hasil</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td>
                      <input type="text" class="form-control" value="{{$item->nama}}">
                    </td>
                    <td>
                      <select class="form-select" aria-label="Default select example">
                        <option selected>-- Pilih Produk Siswa --</option>
                        @foreach ($karyas as $kry)
                            @if (auth()->user()->guru->mapel_id === $kry->mapel_id)
                                <option value="{{ $kry->id }}">{{ $kry->nama }}</option>
                            @endif
                        @endforeach
                      </select>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="nilai">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="deskripsi">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="hasil">
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main>
@endsection