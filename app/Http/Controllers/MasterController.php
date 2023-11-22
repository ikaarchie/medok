<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index()
    {
        $master = Master::latest('id')->paginate(1000);

        return view('master.index')->with('master', $master);
    }

    public function add(Request $request)
    {
        $data = new Master();
        $data->item = $request->input('item');
        $data->jenis = $request->input('jenis');
        $data->status = $request->input('status');
        $data->save();

        return redirect('/master')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(Request $request, $id)
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
