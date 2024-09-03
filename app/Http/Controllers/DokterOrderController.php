<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Master;
use App\Models\DokterOrder;
use Illuminate\Http\Request;
use App\Events\DokterOrderCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

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
        // $order_list = DokterOrder::where('status', '!=', 'Selesai')->latest()->get();
        $order_list = DokterOrder::whereNotIn('status', ['Sedang Diantar', 'Selesai'])->latest()->get();
        if ($request->expectsJson()) {
            return response()->json(['order_list' => $order_list], 200);
        }

        // cara 3
        // if ($request->ajax()) {
        //     $order_list = DokterOrder::where('status', '!=', 'Selesai')->latest()->get();
        //     return response()->json(['order_list' => $order_list]);
        // }

        $ipAddress = \Request::ip();

        return view('dokterorder.order_list', compact('order_list', 'makanan', 'minuman', 'ipAddress'));
    }

    public function add()
    {
        $dokter = Dokter::orderBy('nama', 'ASC')->get();
        $list_dokter =  [];
        foreach ($dokter as $doctor) {
            $list_dokter[$doctor->nama] = $doctor->nama;
        }

        $currentTime = Carbon::now();
        $minTime = $currentTime->copy()->addMinutes(30)->format('H:i');
        $minDate = $currentTime->copy()->addMinutes(30)->format('Y-m-d');

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

        return view('dokterorder.index', compact('list_dokter', 'minTime', 'minDate', 'list_makanan', 'list_minuman', 'ket_makanan', 'ket_minuman'));
    }

    public function save(Request $request)
    {
        // Tambahkan validasi
        $validator = Validator::make($request->all(), [
            'tanggal_disajikan' => 'required|date_format:Y-m-d|after_or_equal:' . Carbon::now()->addMinutes(30)->format('Y-m-d'),
            'waktu_disajikan' => 'required|date_format:H:i|after_or_equal:' . Carbon::now()->addMinutes(30)->format('H:i'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, simpan data
        $data = new DokterOrder();
        $data->nama = $request->input('nama');
        $data->tanggal_disajikan = $request->input('tanggal_disajikan');
        $data->waktu_disajikan = $request->input('waktu_disajikan');
        $data->makanan = $request->input('makanan');
        $data->ket_makanan = $request->input('ket_makanan');
        $data->ops_ket_makanan = $request->input('ops_ket_makanan');
        $data->minuman = $request->input('minuman');
        $data->ket_minuman = $request->input('ket_minuman');
        $data->ops_ket_minuman = $request->input('ops_ket_minuman');
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

    public function selesai_dokter(Request $request, $id)
    {
        $selesai = DokterOrder::where(['id' => $id])->first();
        $selesai->status = 'Selesai';
        $selesai->selesai = Carbon::now();
        $selesai->save();

        DokterOrderCreated::dispatch();

        return redirect('/tracking');
    }

    // public function selesai_admin(Request $request, $id)
    // {
    //     $selesai = DokterOrder::where(['id' => $id])->first();
    //     $selesai->status = 'Selesai';
    //     $selesai->selesai = Carbon::now();
    //     $selesai->save();

    //     DokterOrderCreated::dispatch();

    //     return redirect('/monitoring');
    // }

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

    public function pantry(Request $request)
    {
        $monitoring = DokterOrder::where('status', '!=', 'Selesai')->latest()->get();
        if ($request->expectsJson()) {
            return response()->json(['monitoring' => $monitoring], 200);
        }
        return view('master.pantry');
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

    // public function tracking_cara2(Request $request)
    // {
    //     $query = DokterOrder::query();
    //     $dokter = DokterOrder::select('nama')->orderBy('nama', 'ASC')->distinct()->get();

    //     if ($request->ajax()) {
    //         // Memeriksa apakah filter dokter diterapkan
    //         if ($request->has('dokter') && $request->dokter != '') {
    //             $query->where('nama', $request->dokter);
    //         }
    //         $tracking = $query->orderBy('belum_diproses', 'DESC')->get();
    //         return response()->json(['tracking' => $tracking], 200);
    //     }

    //     $tracking = $query->paginate(1000);

    //     return view('dokterorder.tracking', compact('dokter', 'tracking'));
    // }

    // public function print($id)
    // {
    //     $data = DokterOrder::where('id', $id)->get();

    //     return view('master.print')->with('data', $data);
    // }

    public function print($id)
    {
        // Ambil data berdasarkan id
        $data = DokterOrder::findOrFail($id);

        // Render tampilan untuk dicetak
        $view = view('master.print', compact('data'))->render();

        return response($view);
    }

    public function tarikdata(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $data = DokterOrder::whereDate('belum_diproses', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('belum_diproses', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')->paginate(1000);

            return view('master.tarik_data', compact('data', 'range_tgl'));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
