<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $makanan = Master::where('jenis', 'Makanan')->orderBy('item', 'ASC')->paginate(1000);
        $minuman = Master::where('jenis', 'Minuman')->orderBy('item', 'ASC')->paginate(1000);


        return view('master.data_menu', compact('makanan', 'minuman'));
    }

    public function add(Request $request)
    {
        $data = new Master();
        $data->item = $request->input('item');
        $data->jenis = $request->input('jenis');
        $data->keterangan = $request->input('keterangan');
        $data->status = $request->input('status');
        $data->save();

        return redirect('/master')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $master = Master::find($id);
        $input = $request->all();
        $master->fill($input)->save();

        return redirect('/master');
    }

    public function delete($id)
    {
        $master = Master::find($id);
        $master->delete();

        return redirect('/master');
    }
}
