<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rayon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $rayons = Rayon::with('user')
            ->when($query, function ($q) use ($query) {
                $q->where('rayon', 'like', '%' . $query . '%')
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    });
            })
            ->simplePaginate(5);

        return view('terlambat.admin.rayon.index', compact('rayons', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('terlambat.admin.rayon.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);
    
        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);
    
        return redirect()->route('terlambat.admin.rayon.index')->with('success', 'Berhasil menambahkan data rayon!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function show(Rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rayons = Rayon::find($id);
        $users = User::all(); // Ambil data User untuk dropdown pembimbing
    
        return view('terlambat.admin.rayon.edit', compact('rayons', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);
    
        Rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]); 
    
        return redirect()->route('terlambat.admin.rayon.index')->with('success', 'Berhasil mengubah data rayon!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rayon  $rayon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rayons = Rayon::find($id);
        if (!$rayons) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $studentUsingRayon = $rayons->student()->exists();
        if ($studentUsingRayon) {
            return redirect()->back()->with('gagal', 'Data rombel sedang digunakan dalam relasi.');
        } else {
        $rayons->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
        }
    }
}