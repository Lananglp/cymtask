<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Toko;

class TokoController extends Controller
{
    public function index()
    {
        $toko = Toko::latest()->get();

        return view('toko.index', compact('toko'));
    }

    public function create()
    {
        return view('toko.create');
    }

    public function show()
    {
        return view('toko.show');
    }
}
