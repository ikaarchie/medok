<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Master;
use App\Models\DokterOrder;
use Illuminate\Http\Request;
use App\Events\DokterOrderCreated;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DokterOrderController extends Controller
{
    public function index(Request $request)
    {
        $makanan = Master::where([['jenis', 'Makanan'], ['status', 'Tersedia']])->orderBy('item', 'ASC')->get();
        $minuman = Master::where([['jenis', 'Minuman'], ['status', 'Tersedia']])->orderBy('item', 'ASC')->get();

        // cara 1
        // if ($request->expectsJson()) {
        //     $order_list = DokterOrder::where('status', '!=', 'Selesai')->latest()->get();
        //     return response()->json(['order_list' => $order_list], 200);
        // }

        // cara 2
        $order_list = DokterOrder::where('status', '!=', 'Selesai')->latest()->get();
        if ($request->expectsJson()) {
            return response()->json(['order_list' => $order_list], 200);
        }

        // cara 3
        // if ($request->ajax()) {
        //     $order_list = DokterOrder::where('status', '!=', 'Selesai')->latest()->get();
        //     return response()->json(['order_list' => $order_list]);
        // }

        return view('dokterorder.order_list', compact('order_list', 'makanan', 'minuman'));
    }

    public function add()
    {
        $dokter = Dokter::orderBy('nama', 'ASC')->get();
        $list_dokter =  [];
        foreach ($dokter as $doctor) {
            $list_dokter[$doctor->nama] = $doctor->nama;
        }

        $makanan = Master::where([['jenis', 'Makanan'], ['status', 'Tersedia']])->orderBy('item', 'ASC')->get();
        $list_makanan =  [];
        foreach ($makanan as $makan) {
            $list_makanan[$makan->item] = $makan->item;
        }

        $minuman = Master::where([['jenis', 'Minuman'], ['status', 'Tersedia']])->orderBy('item', 'ASC')->get();
        $list_minuman =  [];
        foreach ($minuman as $minum) {
            $list_minuman[$minum->item] = $minum->item;
        }

        $ketMakanan = Master::select('item')->where([['jenis', 'Makanan'], ['keterangan', 'Aktif'], ['status', 'Tersedia']])->orderBy('item', 'ASC')->get();
        $ket_makanan =  [];
        foreach ($ketMakanan as $ket_mkn) {
            $ket_makanan[$ket_mkn->item] = $ket_mkn->item;
        }

        $ketMinuman = Master::select('item')->where([['jenis', 'Minuman'], ['keterangan', 'Aktif'], ['status', 'Tersedia']])->orderBy('item', 'ASC')->get();
        $ket_minuman =  [];
        foreach ($ketMinuman as $ket_mnm) {
            $ket_minuman[$ket_mnm->item] = $ket_mnm->item;
        }

        $order_list = DokterOrder::latest()->get();

        return view('dokterorder.index', compact('list_dokter', 'list_makanan', 'list_minuman', 'ket_makanan', 'ket_minuman'));
    }

    public function save(Request $request)
    {
        $data = new DokterOrder();
        $data->nama = $request->input('nama');
        $data->tanggal_tindakan = $request->input('tanggal_tindakan');
        $data->waktu_tindakan = $request->input('waktu_tindakan');
        $data->makanan = $request->input('makanan');
        $data->ket_makanan = $request->input('ket_makanan');
        $data->minuman = $request->input('minuman');
        $data->ket_minuman = $request->input('ket_minuman');
        $data->status = 'Belum Diproses';
        $data->belum_diproses = Carbon::now();
        $data->sedang_diproses = $request->input('sedang_diproses');
        $data->menunggu_pengantaran = $request->input('menunggu_pengantaran');
        $data->sedang_diantar = $request->input('sedang_diantar');
        $data->selesai = $request->input('selesai');
        $data->save();

        DokterOrderCreated::dispatch();

        Alert::image('<h1 style="color:black"><b>Terimakasih!</b></h1>', '<h6 style="color:black"><b>Pesanan anda sudah diterima</b></h6>', '../public/img/koki.gif', '150', '150', 'koki')
            ->showConfirmButton(false, '#FFFFFF00')
            ->autoClose(4000)
            ->background('#FFFFFFCC')
            ->buttonsStyling(false)
            ->width('20rem')
            ->toHtml();

        return redirect('/dokterorder');
    }

    public function sedangdiproses(Request $request, $id)
    {
        $sedangdiproses = DokterOrder::where(['id' => $id])->first();
        $sedangdiproses->status = 'Sedang Diproses';
        $sedangdiproses->sedang_diproses = Carbon::now();
        $sedangdiproses->save();

        DokterOrderCreated::dispatch();

        return redirect('/orderlist');
    }
    // public function sedangdiproses(Request $request, $id)
    // {
    //     if ($request->isMethod('post')) {
    //         $sedangdiproses = DokterOrder::findOrFail($id); // Menggunakan findOrFail agar melempar 404 jika tidak ditemukan

    //         $sedangdiproses->status = 'Sedang Diproses';
    //         $sedangdiproses->sedang_diproses = Carbon::now();
    //         $sedangdiproses->save();

    //         DokterOrderCreated::dispatch();

    //         return response()->json(['message' => 'Data berhasil diperbarui'], 200);
    //     }

    //     return redirect('/orderlist');
    // }

    public function menunggupengantaran(Request $request, $id)
    {
        $menunggupengantaran = DokterOrder::where(['id' => $id])->first();
        $menunggupengantaran->status = 'Menunggu Pengantaran';
        $menunggupengantaran->menunggu_pengantaran = Carbon::now();
        $menunggupengantaran->save();

        DokterOrderCreated::dispatch();

        return redirect('/orderlist');
    }

    public function sedangdiantar(Request $request, $id)
    {
        $sedangdiantar = DokterOrder::where(['id' => $id])->first();
        $sedangdiantar->status = 'Sedang Diantar';
        $sedangdiantar->sedang_diantar = Carbon::now();
        $sedangdiantar->save();

        DokterOrderCreated::dispatch();

        return redirect('/orderlist');
    }

    public function selesai(Request $request, $id)
    {
        $selesai = DokterOrder::where(['id' => $id])->first();
        $selesai->status = 'Selesai';
        $selesai->selesai = Carbon::now();
        $selesai->save();

        DokterOrderCreated::dispatch();

        return redirect('/orderlist');
    }

    public function monitoring(Request $request)
    {
        $monitoring = DokterOrder::latest()->get();
        if ($request->expectsJson()) {
            return response()->json(['monitoring' => $monitoring], 200);
        }

        return view('master.data_monitoring');
    }

    public function ok(Request $request)
    {
        $monitoring = DokterOrder::latest()->get();
        if ($request->expectsJson()) {
            return response()->json(['monitoring' => $monitoring], 200);
        }
        return view('master.ok');
    }

    public function tracking(Request $request)
    {
        $query = DokterOrder::query();
        $dokter = DokterOrder::select('nama')->orderBy('nama', 'ASC')->distinct()->get();

        if ($request->ajax()) {
            $tracking = $query->where(['nama' => $request->dokter])
                ->orderBy('belum_diproses', 'DESC')
                ->get();
            return response()->json(['tracking' => $tracking], 200);
        }

        $tracking = $query->paginate(1000);

        return view('dokterorder.tracking', compact('dokter', 'tracking'));
    }
}
