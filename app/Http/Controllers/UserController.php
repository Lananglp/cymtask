<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
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

        if (strlen($request->input('password')) < 8) {
            return redirect()->back()->with('warning', 'Password harus terdiri dari minimal 8 karakter.');
        }
        if ($request->input('password_confirmation') !== $request->input('password')) {
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

        return redirect('/users')->with('success', 'Akun baru berhasil ditambah.');
    }

    public function edit($id)
    {
        return view('users.edit');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required'],
            'umur' => ['required'],
            'agama' => ['required'],
            'alamat' => ['required'],
        ]);

        $users = User::find($id);
        $users->tempat_lahir = $request->input('tempat_lahir');
        $users->tanggal_lahir = $request->input('tanggal_lahir');
        $users->jenis_kelamin = $request->input('jenis_kelamin');
        $users->no_hp = $request->input('no_hp');
        $users->umur = $request->input('umur');
        $users->agama = $request->input('agama');
        $users->alamat = $request->input('alamat');
        $users->save();

        return redirect('/users')->with('success', 'Berhasil melengkapi data akun.');
    }

    public function editPassword($id)
    {
        return view('users.editPassword');
    }

    public function updatePassword($id, Request $request)
    {
        $request->validate([
            'password_lama' => ['required'],
            'password' => ['required'],
        ]);

        if (!Hash::check($request->password_lama, auth()->user()->password)) {
            return redirect()->back()->with('danger', 'Password lama yang anda masukan salah.');
        }

        if (strlen($request->password) < 8) {
            return redirect()->back()->with('warning', 'Password harus terdiri dari minimal 8 karakter.');
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->with('warning', 'Validasi password tidak sesuai dengan password baru.');
        }

        $users = User::find($id);
        $users->password = Hash::make($request->input('password'));
        $users->save();

        return redirect('/users')->with('success', 'Anda berhasil mengubah password.');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->back()->with('warning', 'Data Akun telah dihapus.');
    }
}
