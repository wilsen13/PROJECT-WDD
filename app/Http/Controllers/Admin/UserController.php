<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        // mengambil semua data user
        $users = User::orderBy('id', 'desc')->get();
        
        return view('admin.users.index', compact('users'));
    }

    // untuk hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // agar admin gak bisa hapus akun dia sendiri
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin tidak bisa dihapus!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}