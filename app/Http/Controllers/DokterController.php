<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::orderBy('nama', 'ASC')->paginate(1000);

        return view('dokter.index', compact('dokter'));
    }

    public function add(Request $request)
    {
        $data = new Dokter();
        $data->nama = $request->input('nama');
        $data->save();

        return redirect('/dokter')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(Request $request, $id)
    {
        $dokter = Dokter::find($id);
        $input = $request->all();
        $dokter->fill($input)->save();

        return redirect('/dokter');
    }

    public function delete($id)
    {
        $dokter = Dokter::find($id);
        $dokter->delete();

        return redirect('/dokter');
    }
}
