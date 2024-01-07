<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = $request->input('query');

        $rombels = Rombel::when($query, function ($q) use ($query) {
            $q->where('rombel', 'like', '%' . $query . '%');
        })->simplePaginate(5);

        return view('terlambat.admin.rombel.index', compact('rombels', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('terlambat.admin.rombel.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'rombel' => 'required',
        ]);
        Rombel::create([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('terlambat.admin.rombel.index')->with('success', 'Berhasil menambahkan data rombel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $rombels = Rombel::find($id);

        return view('terlambat.admin.rombel.edit', compact('rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'rombel' => 'required',
        ]);
        Rombel::where('id', $id)->update([
            'rombel' =>$request->rombel,
        ]);
        return redirect()->route('terlambat.admin.rombel.index')->with('success', 'Berhasil mengubah data rombel!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $rombels = Rombel::find($id);
        if (!$rombels) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $siswaUsingRombel = $rombels->student()->exists();
        if ($siswaUsingRombel) {
            return redirect()->back()->with('gagal', 'Data rombel sedang digunakan dalam relasi.');
        } else {
        $rombels->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
        }
    }
}
