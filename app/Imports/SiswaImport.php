<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Siswa;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Siswa::create([
                'nama' => $row[0],
                'nisn' => $row[1],
                'kelas' => $row[2],
                'mapel_id' => $row[3],
            ]);
        }
    }
}
