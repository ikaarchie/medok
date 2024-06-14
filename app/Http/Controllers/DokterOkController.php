<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterOkController extends Controller
{
    public function index()
    {
        $dokter = Dokter::latest()->paginate(1000);

        return view('dokter_ok.index', compact('dokter'));
    }

    public function add(Request $request)
    {
        $data = new Dokter();
        $data->nama = $request->input('nama');
        $data->save();

        return redirect('/dokter_ok')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(Request $request, $id)
    {
        $dokter = Dokter::find($id);
        $input = $request->all();
        $dokter->fill($input)->save();

        return redirect('/dokter_ok');
    }

    public function delete($id)
    {
        $dokter = Dokter::find($id);
        $dokter->delete();

        return redirect('/dokter_ok');
    }
}
