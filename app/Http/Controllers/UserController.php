<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = $request->input('query');

        $users = User::when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('role', 'like', '%' . $query . '%');
        })->paginate(5);

        return view('terlambat.admin.user.index', compact('users', 'query'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('terlambat.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make(substr($request->email, 0, 3) . substr($request->name, 0, 3))
        ]);

        return redirect()->route('terlambat.admin.user.index')->with('success', 'Berhasil menambahkan data pengguna!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $users = User::find($id);

        return view('terlambat.admin.user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        if ($request->password == "") {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' =>$request->password,
        ]);

    }
        return redirect()->route('terlambat.admin.user.index')->with('success', 'Update data telah berhasil');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $users = User::find($id);
        if (!$users) {
            return redirect()->back()->with('gagal', 'Data tidak ditemukan');
        }
        $rayonUsingUser = $users->rayon()->exists();
        if ($rayonUsingUser) {
            return redirect()->back()->with('gagal', 'Data rombel sedang digunakan dalam relasi.');
        } else {
        $users->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data');
        }
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|alpha_dash',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'password.required' => 'Password harus diisi',
            'password.alpha_dash' => 'Password harus berisi huruf dan karakter tanpa spasi'
        ]);

        $user = $request->only(['email', 'password']);
        if(Auth::attempt($user)){
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar');
        }
    }
    
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
