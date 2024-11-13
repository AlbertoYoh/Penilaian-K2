@extends('layouts.admin');

@section('title')
    Dashboard | Nilai
@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Nilai</h1>
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
              <h5 class="card-title">Nama Siswa</h5>
              
              <!-- Table with stripped rows -->
              <table class="table table-striped" id="">
                <thead>
                  <tr>
                    <th scope="col" width="50%">Nama</th>
                    <th scope="col" width=15%>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($siswas as $siswa)
                      @if (auth()->user()->guru->mapel_id === $siswa->mapel_id)
                          <tr>
                              <td>{{ $siswa->nama }}</td>
                              <td>
                                  @if ($siswa->nilai) <!-- Cek jika siswa sudah memiliki nilai -->
                                      <!-- Tombol Detail Nilai -->
                                      <a href="{{ route('detailNilai', $siswa->id) }}" class="btn btn-warning">Detail Nilai</a>
                                  @else
                                      <!-- Jika belum ada nilai, tampilkan tombol tambah nilai -->
                                      <a href="{{ route('tambahNilai', $siswa->id) }}" class="btn btn-primary">Tambah Nilai</a>
                                  @endif
                              </td>
                          </tr>
                      @endif
                  @endforeach
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