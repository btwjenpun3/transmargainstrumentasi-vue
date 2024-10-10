<?php

namespace App\Traits;

use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

trait GenerateLaporanNumber
{
    public function generateLaporanNumber()
    {
        $last = Laporan::orderBy('id', 'desc')->first();

        if ($last) {            
            $number = (int) filter_var($last->no, FILTER_SANITIZE_NUMBER_INT);
            
            $newNumber = $number + 1;

            $result = 'Laporan/' . $newNumber;

        } else {
            $result = 'Laporan/1';
        }

        return $result;
    }
}