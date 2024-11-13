<!DOCTYPE html>
<html>
<head>
    <title>Detail Nilai Siswa</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('{{ base_path('public/fonts/Poppins-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Poppins2';
            src: url('{{ base_path('public/fonts/Poppins-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        body {
            font-family: 'Poppins'; margin: 0; padding: 0; }
        h2, th, strong {
            font-family: 'Poppins2';
            font-weight: 700; /* Gunakan font Poppins-Bold */
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .info-table { width: 100%; margin-bottom: 30px; border: none;}
        .info-table td { padding: 5px; vertical-align: top; border: none;}
        .left { text-align: left; }
        .center { text-align: center; }
        .ttd-section {position: absolute; right: 30px; text-align: center; }
        .ttd { width: 100px; height: auto; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Raport Integred Kristen 2 YSKI</h2>
    </div>

    <div class="center">
        <img src="{{ public_path('logoyski.png') }}" alt="Logo" style="width: 80px;">
    </div>
    
    <table class="info-table">
        <tr>
            <td class="left" width="30%">
                <strong>Nama:</strong> {{ $siswa->nama }} <br>
                <strong>NISN:</strong> {{ $siswa->nisn }}
            </td>
            <td class="center" width="60%">
            </td>
            <td class="left" width="10%">
                <strong>Kelas:</strong> {{ $siswa->kelas }} <br>
                <strong>Mapel:</strong> {{ $guru->mapel->nama ?? '-' }}
            </td>
        </tr>
    </table>


    <!-- Tabel Nilai -->
    <div style="margin-top: 30px"> </div>
    <table>
        <thead style="font-family: 'poppins', sans-serif;">
            <tr>
                <th>Nama</th>
                <th>Produk</th>
                <th>Nilai</th>
                <th>Deskripsi</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $nilai->karya->nama ?? '-' }}</td>
                <td>{{ $nilai->nilai }}</td>
                <td>{{ $nilai->deskripsi }}</td>
                <td><a href="{{ $nilai->hasil }}">Lihat Hasil Karya</a></td>
            </tr>
        </tbody>
    </table>

    <!-- Bagian Tanda Tangan di Pojok Kanan Bawah -->
    <div style="margin-top: 40px"> </div>
    <div class="ttd-section">
        <p>Semarang, {{ $tanggal }}</p>
        <img src="{{ public_path( $guru->ttd ) }}" alt="Tanda Tangan" class="ttd"><br>
        <p>{{ $guru->nama }}</p>
    </div>
</body>
</html>
