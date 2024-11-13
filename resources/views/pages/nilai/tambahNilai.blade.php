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

              <!-- Table with stripped rows -->
              <form action="{{ route('nilai.store', $item->id) }}" method="POST">
                @csrf
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" width="10%">Nama</th>
                            <th scope="col" width="12%">Produk</th>
                            <th scope="col" width="10%">Nilai</th>
                            <th scope="col" width="20%">Deskripsi</th>
                            <th scope="col" width="15%">Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- for loop --}}
                            
                            <!-- Nama Siswa -->
                            <td>
                                <input type="text" class="form-control" value="{{ $item->nama }}" readonly>
                            </td>
            
                            <!-- Produk Siswa -->
                            <td>
                                <select class="form-select" name="karya_id" aria-label="Pilih Produk Siswa">
                                    <option selected disabled>-- Pilih Produk Siswa --</option>
                                    @foreach ($karyas as $kry)
                                        @if (auth()->user()->guru->mapel_id === $kry->mapel_id)
                                            <option value="{{ $kry->id }}">{{ $kry->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
            
                            <!-- Nilai -->
                            <td>
                                <input type="number" class="form-control" name="nilai" placeholder="Nilai" required>
                            </td>
            
                            <!-- Deskripsi -->
                            <td>
                                <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                            </td>
            
                            <!-- Hasil -->
                            <td>
                                <input type="text" class="form-control" name="hasil" placeholder="Hasil" required>
                            </td>
                        </tr>
                    </tbody>
                </table>
            
                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary mt-3">Simpan Nilai</button>
            </form>
            
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main>
@endsection