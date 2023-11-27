<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DokterOrder;
use Illuminate\Http\Request;
use App\Events\DokterOrderCreated;
use App\Models\Master;

class DokterOrderController extends Controller
{
    public function index(Request $request)
    {
        $makanan = Master::where([['jenis', 'Makanan'], ['status', 'Aktif']])->orderBy('item', 'ASC')->get();
        $minuman = Master::where([['jenis', 'Minuman'], ['status', 'Aktif']])->orderBy('item', 'ASC')->get();

        if ($request->expectsJson()) {
            $order_list = DokterOrder::latest()->get();
            return response()->json(['order_list' => $order_list], 200);
        }
        return view('dokterorder.order_list', compact('makanan', 'minuman'));
    }

    public function create()
    {
        $makanan = Master::where([['jenis', 'Makanan'], ['status', 'Aktif']])->orderBy('item', 'ASC')->get();
        $list_makanan =  [];
        foreach ($makanan as $makan) {
            $list_makanan[$makan->item] = $makan->item;
        }

        $minuman = Master::where([['jenis', 'Minuman'], ['status', 'Aktif']])->orderBy('item', 'ASC')->get();
        $list_minuman =  [];
        foreach ($minuman as $minum) {
            $list_minuman[$minum->item] = $minum->item;
        }

        $order_list = DokterOrder::latest()->get();

        return view('dokterorder.index', compact('list_makanan', 'list_minuman'));
    }

    public function store(Request $request)
    {
        $data = new DokterOrder();
        $data->nama = $request->input('nama');
        $data->waktu_tindakan = $request->input('waktu_tindakan');
        $data->makanan = $request->input('makanan');
        $data->minuman = $request->input('minuman');
        $data->status = 'Belum Diproses';
        $data->belum_diproses = Carbon::now();
        $data->sedang_diproses = $request->input('sedang_diproses');
        $data->menunggu_pengantaran = $request->input('menunggu_pengantaran');
        $data->sedang_diantar = $request->input('sedang_diantar');
        $data->selesai = $request->input('selesai');
        $data->save();

        DokterOrderCreated::dispatch();

        return redirect('/dokterorder');
    }

    public function sedangdiproses(Request $request, $id)
    {
        $sedangdiproses = DokterOrder::where(['id' => $id])->first();
        $sedangdiproses->status = 'Sedang Diproses';
        $sedangdiproses->sedang_diproses = Carbon::now();
        $sedangdiproses->save();

        DokterOrderCreated::dispatch();

        return redirect('/dokterorder/order_list');
    }

    public function menunggupengantaran(Request $request, $id)
    {
        $menunggupengantaran = DokterOrder::where(['id' => $id])->first();
        $menunggupengantaran->status = 'Menunggu Pengantaran';
        $menunggupengantaran->menunggu_pengantaran = Carbon::now();
        $menunggupengantaran->save();

        DokterOrderCreated::dispatch();

        return redirect('/dokterorder/order_list');
    }

    public function sedangdiantar(Request $request, $id)
    {
        $sedangdiantar = DokterOrder::where(['id' => $id])->first();
        $sedangdiantar->status = 'Sedang Diantar';
        $sedangdiantar->sedang_diantar = Carbon::now();
        $sedangdiantar->save();

        DokterOrderCreated::dispatch();

        return redirect('/dokterorder/order_list');
    }

    public function selesai(Request $request, $id)
    {
        $selesai = DokterOrder::where(['id' => $id])->first();
        $selesai->status = 'Selesai';
        $selesai->selesai = Carbon::now();
        $selesai->save();

        DokterOrderCreated::dispatch();

        return redirect('/dokterorder/order_list');
    }

    public function monitoring(Request $request)
    {
        if ($request->expectsJson()) {
            $monitoring = DokterOrder::latest()->get();
            return response()->json(['monitoring' => $monitoring], 200);
        }
        return view('master.data_monitoring');
    }
}
