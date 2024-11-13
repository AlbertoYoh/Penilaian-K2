@extends('layouts.admin')

@section('title')
    Dashboard | Detail Nilai
@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Detail Nilai Siswa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Detail Nilai</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detail Nilai untuk {{ $siswa->nama ?? 'Nama Siswa Tidak Ditemukan' }}</h5>
              <a href="{{ route('nilai.exportPdf', $siswa->id) }}" class="btn btn-success">
                Export ke PDF
              </a>
            

              <!-- Cek apakah nilai ada -->
              @if ($nilai)
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Produk</th>
                      <th scope="col">Nilai</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Hasil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <!-- Menampilkan Nama Karya -->
                      <td>{{ $nilai->karya->nama ?? 'Nama Karya Tidak Ditemukan' }}</td>
                      <td>{{ $nilai->nilai }}</td>
                      <td>{{ $nilai->deskripsi }}</td>
                      <td>{{ $nilai->hasil }}</td>
                    </tr>
                  </tbody>
                </table>
              @else
                <p>Nilai untuk siswa ini belum ditambahkan.</p>
              @endif

              <a href="{{ route('nilai') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </section>

</main>
@endsection
