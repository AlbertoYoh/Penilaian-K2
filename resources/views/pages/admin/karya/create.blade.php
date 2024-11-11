@extends('layouts.admin')

@section('title')
    Dashboard | Karya
@endsection

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Karya</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Karya</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Karya</h5>

              <form action="{{route('karya.store')}}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Karya</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama Karya..." value="{{old('nama')}}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Select</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="mapel_id">
                      <option selected="">Pilih Mapel</option>
                      @foreach ($mapels as $mpl)
                        <option value="{{$mpl->id}}">{{$mpl->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">Tambah <i class="fa-solid fa-floppy-disk ms-2"></i></button>
                        <button type="reset" class="btn btn-warning">Reset <i class="fa-solid fa-repeat ms-2"></i></button>
                        <a href="{{route('karya.index')}}" class="btn btn-secondary">Kembali <i class="fa-solid fa-backward ms-2"></i></a>
                    </div>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

</main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush