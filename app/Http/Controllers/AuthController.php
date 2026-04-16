<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    public function showLogin()
    {
        if(Auth::check()){
            if(Auth::user()->role=='admin') return redirect('/admin/dashboard');
            return redirect('/siswa/dashboard');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate(
            ['username'=>'required','password'=>'required'],
            [
                'username.required'=>'Username/NIS wajib diisi',
                'password.required'=>'Password wajib diisi'
            ]
        );

        if(Auth::attempt($request->only(['username','password']))){

            $request->session()->regenerate();

            if(Auth::user()->role=='admin'){
                return redirect('/admin/dashboard')->with('success','Berhasil login');
            }

            return redirect('/siswa/dashboard')->with('success','Berhasil login');
        }

        return back()->with('error','NIS/NIP atau Password salah');
    }

    public function register(Request $request)
    {
        $request->validate(

            [
                'name'=>'required|regex:/^[a-zA-Z\s]+$/',

                // FORMAT PW BIKIN AKUN
                'username'=>[
                    'required',
                    'unique:users,username',
                    'regex:/^[0-9]{1}\.[0-9]{2}\.[0-9]{6}$/'
                ],

                'kelas'=>'required',
                'password'=>'required|min:6'
            ],

            [
                'name.required'=>'Nama wajib diisi',
                'name.regex'=>'Nama hanya boleh huruf',

                'username.required'=>'NIS wajib diisi',
                'username.unique'=>'NIS sudah terdaftar',
                'username.regex'=>'Format NIS harus seperti 1.23.456789',

                'kelas.required'=>'Kelas wajib dipilih',

                'password.required'=>'Password wajib diisi',
                'password.min'=>'Password minimal 6 karakter'
            ]
        );

        User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'kelas'=>$request->kelas,
            'password'=>bcrypt($request->password),
            'role'=>'siswa'
        ]);

        return redirect('/login')->with('success','Akun berhasil dibuat');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success','Berhasil logout');
    }
}
