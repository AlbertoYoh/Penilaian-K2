@extends('layouts.admin')

@section('title')
    Dashboard | Mapel
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
              <h5 class="card-title">Data Mapel</h5>
              <a href="{{route('mapel.create')}}" class="btn btn-primary mb-2">
                Tambah Data <i class="fa-solid fa-plus ms-2"></i>
              </a>

              <!-- Table with stripped rows -->
              <table class="table table-striped" id="tabelMapel">
                <thead>
                  <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col" width= "15%">Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var datatable = $('#tabelMapel').DataTable({
          processing: true,
          serverSide: true,
          ordering: true,
          ajax: {
            url: '{!! url()->current() !!}',
          },
          columns: [
            {
                data: null, 
                name: 'nomor', 
                orderable: false, 
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Menampilkan nomor urut
                }
            },
            { data: 'nama', name: 'nama' },
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searcable: false,
              width: '15%'
            },
          ]
      })
    </script>
    <script>
      new DataTable('#tableMapel');
    </script>
@endpush