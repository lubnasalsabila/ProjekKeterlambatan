<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\Models\Late;
use App\Models\Student;
use App\Exports\ExcelExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = $request->input('query');

        $lates = Late::with('student')
            ->when($query, function ($q) use ($query) {              
                $q->where('date_time_late', 'like', '%' . $query . '%')
                ->orWhere('information', 'like', '%' . $query . '%')
                ->orwhereHas('student', function ($q) use ($query) {
                    $q->where('nis', 'like', '%' . $query . '%');
                        
                });
            })
            ->simplePaginate(10);
        if (Auth::user()->role == 'Administrator'){
            return view('terlambat.admin.keterlambatan.index', compact('lates', 'query'));
        } else {
            return view('terlambat.ps.index', compact('lates', 'query'));
        }
    }

    public function rekap(Request $request)
    {
        //
        $query = $request->input('query');

        $lates = Late::with('student')->
                when($query, function ($q) use ($query) {              
                $q->whereHas('student', function ($q) use ($query) {
                    $q->where('nis', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%');                        
                });
            })->simplePaginate(10);

        if (Auth::user()->role == 'Administrator'){
            return view('terlambat.admin.keterlambatan.rekap', compact('lates', 'query'));
        } else {
            return view('terlambat.ps.rekap', compact('lates', 'query'));
        }
    }
    public function lihat(string $student_id)
    {
        
        $lates = Late::with('student')->where('student_id', $student_id)->orderBy('date_time_late', 'asc')->get();
        $siswas = Student::with('rombel', 'rayon')->find($student_id);
        if ($lates->isEmpty()) {
            return redirect()->route('terlambat.admin.keterlambatan.rekap')->with('gagal', 'Data tidak dapat ditemukan' . $student_id);
        } else if (Auth::user()->role == 'Administrator'){
            return view('terlambat.admin.keterlambatan.lihat', compact('lates', 'siswas'));
        } else {
            return view('terlambat.ps.lihat', compact('lates', 'siswas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
        $siswas = Student::all();
        return view('terlambat.admin.keterlambatan.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $lateData = [
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ];

        if ($request->file('bukti')->isValid()) {
            $file = $request->file('bukti');
            $path = $file->store('bukti', 'public');

            $lateData['bukti'] = $path;
        }
    
        Late::create($lateData);
    
        return redirect()->route('terlambat.admin.keterlambatan.index')->with('success', 'Berhasil menambahkan data siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $lates = Late::with('student')->find($id);
        if(Auth::user()->role == 'Administrator'){
            return view('terlambat.admin.keterlambatan.print', compact('lates'));
        } else {
            return view('terlambat.ps.print', compact('lates'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $lates = Late::with('student')->find($id);
        $siswas = Student::all(); // Ambil data User untuk dropdown rombel   
        return view('terlambat.admin.keterlambatan.edit', compact('lates', 'siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
        ]);
    
        if ($request->file('bukti')->isValid()) {
            $request->validate([
            'bukti' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);
            $file = $request->file('bukti');
            $path = $file->store('bukti', 'public');
        Late::where('id', $id)->update([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $path,
        ]); 
        } else {
            Late::where('id', $id)->update([
                'date_time_late' => $request->date_time_late,
                'information' => $request->information,
            ]); 
        }

        return redirect()->route('terlambat.admin.keterlambatan.index')->with('success', 'Berhasil mengubah data siswa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Late::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function downloadPDF($id)
    {
        $lates = Late::find($id);

        if (Auth::user()->role == 'Administrator'){
            $pdf = PDF::loadView('terlambat.admin.keterlambatan.download-pdf', compact('lates'));
        } else {
            $pdf = PDF::loadView('terlambat.ps.download-pdf', compact('lates'));
        }
        return $pdf->download('surat-pernyataan.pdf');
        
    }
    public function createExcel()
    {
        $file_name = 'Data-Keterlambatan'.'.xlsx';
        return Excel::download(new ExcelExport, $file_name);

    }
}

