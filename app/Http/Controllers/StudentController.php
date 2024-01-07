<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $siswas = Student::with('rombel', 'rayon')
            ->when($query, function ($q) use ($query) {
                $q->where('nis', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhereHas('rombel', function ($q) use ($query) {
                        $q->where('rombel', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('rayon', function ($q) use ($query) {
                        $q->where('rayon', 'like', '%' . $query . '%');
                    });
            })
            ->simplePaginate(5);
        if (Auth::user()->role == 'Administrator'){
        return view('terlambat.admin.siswa.index', compact('siswas', 'query'));
        } else {
        return view('terlambat.ps.student', compact('siswas', 'query'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $rombels = Rombel::all();
        $rayons = Rayon::all();
        return view('terlambat.admin.siswa.create', compact('rombels', 'rayons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);
    
        Student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);
    
        return redirect()->route('terlambat.admin.siswa.index')->with('success', 'Berhasil menambahkan data siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $siswas = Student::find($id);
        $rombels = Rombel::all(); // Ambil data User untuk dropdown rombel
        $rayons = Rayon::all(); // Ambil data User untuk dropdown rayon
    
        return view('terlambat.admin.siswa.edit', compact('siswas', 'rombels', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);
    
        Student::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]); 
    
        return redirect()->route('terlambat.admin.siswa.index')->with('success', 'Berhasil mengubah data siswa!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $siswas = Student::find($id);
        if (!$siswas) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $lateUsingStudent = $siswas->late()->exists();
        if ($lateUsingStudent) {
            return redirect()->back()->with('gagal', 'Data rombel sedang digunakan dalam relasi.');
        } else {
        $siswas->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
        }
    }

}
