<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username|max:8|min:4',
            'password' => 'required|min:8|max:15',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Akun berhasil didaftarkan! silahkan login');
        } else {
            return redirect()->back()->with('fail', 'Gagal membuat Akun, coba ulang!');
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username|max:15|min:4',
            'password' => 'required|min:8|max:15',
        ], [
            'username.exists' => "This username doesn't exists"
        ]);

        $users = $request->only('username', 'password');
        if (Auth::attempt($users)) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('fail', "Gagal login, periksa dan coba lagi!");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8|max:15',
            'password' => 'required|min:8|max:15|confirmed',
        ]);

        $currentPassword = auth::user()->password;
        $old_password = $request->old_password;
        if (Hash::check($old_password, $currentPassword)) {
            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->back()->with('fail', 'Gagal mengubah password, periksa dan coba lagi!');
        }
    }
}