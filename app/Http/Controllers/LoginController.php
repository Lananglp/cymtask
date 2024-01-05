<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->intended('dashboard')->with('login', 'Anda sudah login sebelumnya sebagai');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::check()) {
            return redirect()->intended('dashboard')->with('login', 'Berhasil login sebagai');
        }
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard')->with('login', 'Berhasil login sebagai');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->with('warning', 'Email atau password yang anda masukan salah, Silahkan masukan data yang benar.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'jabatan' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $kataBahaya = [
            'kontol',
            'Kontoll',
            'Kontolll',

            'anjing',
            'anjingg',
            'anjinggg',

            'anjink',
            'anjinkk',
            'anjinkkk',

            'memex',
            'memexx',
            'memexxx',

            'memek',
            'memekk',
            'memekkk',

            'pepek',
            'pepekk',
            'pepekkk',

            'kontol1',
            'kontol2',
            'kontol3',
            'kontol11',
            'kontol111',
            'kontol22',
            'kontol222',
            'kontol33',
            'kontol333',

            'anjing1',
            'anjing2',
            'anjing3',
            'anjing11',
            'anjing111',
            'anjing22',
            'anjing222',
            'anjing33',
            'anjing333',

            'anjink1',
            'anjink2',
            'anjink3',
            'anjink11',
            'anjink111',
            'anjink22',
            'anjink222',
            'anjink33',
            'anjink333',

            'memex1',
            'memex2',
            'memex3',
            'memex11',
            'memex111',
            'memex22',
            'memex222',
            'memex33',
            'memex333',

            'memek1',
            'memek2',
            'memek3',
            'memek11',
            'memek111',
            'memek22',
            'memek222',
            'memek33',
            'memek333',

            'pepek1',
            'pepek2',
            'pepek3',
            'pepek11',
            'pepek111',
            'pepek22',
            'pepek222',
            'pepek33',
            'pepek333',
        ];

        if (strlen($request->password) < 8) {
            return redirect()->back()->with('warning', 'Password harus terdiri dari minimal 8 karakter.');
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->with('warning', 'Validasi password tidak sesuai dengan password baru.');
        }

        $inputName = $request->input('name');

        foreach ($kataBahaya as $kb) {
            if (stripos($inputName, $kb) !== false) {
                return redirect()->back()->with('warning', 'Gunakan Bahasa yang sopan saat mengisi nama lengkap.');
            }
        }

        $users = new User;
        $users->name = $request->input('name');
        $users->jabatan = $request->input('jabatan');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));
        $users->save();

        return redirect('/')->with('success', 'Berhasil registrasi akun, silahkan melakukan login.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/')->with('logout', 'Anda logout akun.');
    }
}