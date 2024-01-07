<?php

namespace App\Exports;

use App\Models\Late;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Late::with('student')->get();
    }
    public function headings(): array
    {
        return [
            "Nis", "Nama", "Informasi", "Jumlah keterlambatan", "Tanggal"
        ];
    }
    public function map($lates): array
    {
        // Mengambil nilai unik dari student_id
        $uniqueStudentIds = $lates->pluck('student_id')->unique();

        $lateCounts = $uniqueStudentIds->mapWithKeys(function ($studentId) use ($lates) {
            // Mengambil entri pertama untuk setiap student_id
            $late = $lates->where('student_id', $studentId)->first();
            
            return $late ? [
                $studentId => [
                    'Nis' => $late->student->nis,
                    'Name' => $late->student->name,
                    'Informasi' => $late->information,
                    'Jumlah Keterlambatan' => $lates->where('student_id', $studentId)->count(),
                    'Tanggal' => $late->date_time_late,
                ]
            ] : [];
        });

        $rows = array_values($lateCounts->toArray());

        return $rows;

    }

}
