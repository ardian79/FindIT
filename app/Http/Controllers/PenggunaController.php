<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'mahasiswa')
            ->withCount(['laporanKehilangan', 'klaim']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'aktif');
        }

        $pengguna = $query->latest()->get();

        return view('petugas.pengguna.index', compact('pengguna'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->role !== 'mahasiswa') {
            abort(403);
        }

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $statusText = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->nama} berhasil {$statusText}.");
    }
}
