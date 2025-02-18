<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Master;
use App\Models\Kuesioner;
use App\Models\DokterOrder;
use App\Exports\ExportMedok;
use Illuminate\Http\Request;
use App\Events\DokterOrderCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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

    public function checkNama(Request $request)
    {
        $exists = Kuesioner::where('nama', $request->input('nama'))->exists();

        return response()->json(['exists' => $exists]);
    }

    public function kuesioner(Request $request)
    {
        $kuesioner = Kuesioner::orderBy('nama', 'ASC')->paginate(1000);

        return view('kuesioner.kuesioner', compact('kuesioner'));
    }

    public function kepuasan()
    {
        // Ambil data kepuasan dengan pagination
        $kepuasan = Kuesioner::orderBy('nama', 'ASC')->paginate(1000);

        // Mapping nilai kepuasan_1 hingga kepuasan_6 menjadi angka
        $kepuasan->getCollection()->transform(function ($item) {
            // Mapping setiap kepuasan (kepuasan_1, kepuasan_2, dll.)
            for ($i = 1; $i <= 6; $i++) {
                $item->{'kepuasan_' . $i} = match ($item->{'kepuasan_' . $i}) {
                    'Sangat Puas' => 1,
                    'Puas' => 2,
                    'Cukup Puas' => 3,
                    'Tidak Puas' => 4,
                    'Sangat Tidak Puas' => 5,
                    default => 'Tidak Ada Penilaian',
                };
            }

            return $item;
        });

        // Menghitung total nilai kepuasan_1
        $totalKepuasanA1 = $kepuasan->sum(function ($isi) {
            return $isi->kepuasan_1 ?? 0; // Ambil nilai kepuasan_1 yang sudah dimodifikasi (nilai numerik)
        });

        $totalKepuasanA2 = $kepuasan->sum(function ($isi) {
            return $isi->kepuasan_2 ?? 0;
        });

        $totalKepuasanA3 = $kepuasan->sum(function ($isi) {
            return $isi->kepuasan_3 ?? 0;
        });

        $totalKepuasanA4 = $kepuasan->sum(function ($isi) {
            return $isi->kepuasan_4 ?? 0;
        });

        $totalKepuasanA5 = $kepuasan->sum(function ($isi) {
            return $isi->kepuasan_5 ?? 0;
        });

        $totalKepuasanA6 = $kepuasan->sum(function ($isi) {
            return $isi->kepuasan_6 ?? 0;
        });

        // Menghitung jumlah data
        $jumlahKepuasan = $kepuasan->count();

        // Menghitung rata-rata kepuasan_1
        $rataRataKepuasanA1 = round(($jumlahKepuasan > 0 ? $totalKepuasanA1 / $jumlahKepuasan : 0), 2);
        $rataRataKepuasanA2 = round(($jumlahKepuasan > 0 ? $totalKepuasanA2 / $jumlahKepuasan : 0), 2);
        $rataRataKepuasanA3 = round(($jumlahKepuasan > 0 ? $totalKepuasanA3 / $jumlahKepuasan : 0), 2);
        $rataRataKepuasanA4 = round(($jumlahKepuasan > 0 ? $totalKepuasanA4 / $jumlahKepuasan : 0), 2);
        $rataRataKepuasanA5 = round(($jumlahKepuasan > 0 ? $totalKepuasanA5 / $jumlahKepuasan : 0), 2);
        $rataRataKepuasanA6 = round(($jumlahKepuasan > 0 ? $totalKepuasanA6 / $jumlahKepuasan : 0), 2);

        return view('kuesioner.kepuasan', compact('kepuasan', 'totalKepuasanA1', 'totalKepuasanA2', 'totalKepuasanA3', 'totalKepuasanA4', 'totalKepuasanA5', 'totalKepuasanA6', 'rataRataKepuasanA1', 'rataRataKepuasanA2', 'rataRataKepuasanA3', 'rataRataKepuasanA4', 'rataRataKepuasanA5', 'rataRataKepuasanA6'));
    }

    public function kepentingan()
    {
        $kepentingan = Kuesioner::orderBy('nama', 'ASC')->paginate(1000);

        $kepentingan->getCollection()->transform(function ($item) {
            for ($i = 1; $i <= 6; $i++) {
                $item->{'kepentingan_' . $i} = match ($item->{'kepentingan_' . $i}) {
                    'Sangat Penting' => 1,
                    'Penting' => 2,
                    'Cukup Penting' => 3,
                    'Tidak Penting' => 4,
                    'Sangat Tidak Penting' => 5,
                    default => 'Tidak Ada Penilaian',
                };
            }

            return $item;
        });

        $totalKepentinganA1 = $kepentingan->sum(function ($isi) {
            return $isi->kepentingan_1 ?? 0;
        });

        $totalKepentinganA2 = $kepentingan->sum(function ($isi) {
            return $isi->kepentingan_2 ?? 0;
        });

        $totalKepentinganA3 = $kepentingan->sum(function ($isi) {
            return $isi->kepentingan_3 ?? 0;
        });

        $totalKepentinganA4 = $kepentingan->sum(function ($isi) {
            return $isi->kepentingan_4 ?? 0;
        });

        $totalKepentinganA5 = $kepentingan->sum(function ($isi) {
            return $isi->kepentingan_5 ?? 0;
        });

        $totalKepentinganA6 = $kepentingan->sum(function ($isi) {
            return $isi->kepentingan_6 ?? 0;
        });

        $jumlahKepentingan = $kepentingan->count();

        $rataRataKepentinganA1 = round(($jumlahKepentingan > 0 ? $totalKepentinganA1 / $jumlahKepentingan : 0), 2);
        $rataRataKepentinganA2 = round(($jumlahKepentingan > 0 ? $totalKepentinganA2 / $jumlahKepentingan : 0), 2);
        $rataRataKepentinganA3 = round(($jumlahKepentingan > 0 ? $totalKepentinganA3 / $jumlahKepentingan : 0), 2);
        $rataRataKepentinganA4 = round(($jumlahKepentingan > 0 ? $totalKepentinganA4 / $jumlahKepentingan : 0), 2);
        $rataRataKepentinganA5 = round(($jumlahKepentingan > 0 ? $totalKepentinganA5 / $jumlahKepentingan : 0), 2);
        $rataRataKepentinganA6 = round(($jumlahKepentingan > 0 ? $totalKepentinganA6 / $jumlahKepentingan : 0), 2);

        return view('kuesioner.kepentingan', compact('kepentingan', 'totalKepentinganA1', 'totalKepentinganA2', 'totalKepentinganA3', 'totalKepentinganA4', 'totalKepentinganA5', 'totalKepentinganA6', 'rataRataKepentinganA1', 'rataRataKepentinganA2', 'rataRataKepentinganA3', 'rataRataKepentinganA4', 'rataRataKepentinganA5', 'rataRataKepentinganA6'));
    }

    public function hasil()
    {
        // Memanggil function kepuasan
        $kepuasan = $this->kepuasan();
        $kepentingan = $this->kepentingan();
        // dd($kepentingan->rataRataKepentinganA6);

        $rataRataKepuasanA1 = $kepuasan->rataRataKepuasanA1;
        $rataRataKepuasanA2 = $kepuasan->rataRataKepuasanA2;
        $rataRataKepuasanA3 = $kepuasan->rataRataKepuasanA3;
        $rataRataKepuasanA4 = $kepuasan->rataRataKepuasanA4;
        $rataRataKepuasanA5 = $kepuasan->rataRataKepuasanA5;
        $rataRataKepuasanA6 = $kepuasan->rataRataKepuasanA6;

        $rataRataKepentinganA1 = $kepentingan->rataRataKepentinganA1;
        $rataRataKepentinganA2 = $kepentingan->rataRataKepentinganA2;
        $rataRataKepentinganA3 = $kepentingan->rataRataKepentinganA3;
        $rataRataKepentinganA4 = $kepentingan->rataRataKepentinganA4;
        $rataRataKepentinganA5 = $kepentingan->rataRataKepentinganA5;
        $rataRataKepentinganA6 = $kepentingan->rataRataKepentinganA6;

        $perkalianA1 = round(($rataRataKepentinganA1 * $rataRataKepuasanA1), 2);
        $perkalianA2 = round(($rataRataKepentinganA2 * $rataRataKepuasanA2), 2);
        $perkalianA3 = round(($rataRataKepentinganA3 * $rataRataKepuasanA3), 2);
        $perkalianA4 = round(($rataRataKepentinganA4 * $rataRataKepuasanA4), 2);
        $perkalianA5 = round(($rataRataKepentinganA5 * $rataRataKepuasanA5), 2);
        $perkalianA6 = round(($rataRataKepentinganA6 * $rataRataKepuasanA6), 2);

        return view('kuesioner.hasil', compact('rataRataKepuasanA1', 'rataRataKepuasanA2', 'rataRataKepuasanA3', 'rataRataKepuasanA4', 'rataRataKepuasanA5', 'rataRataKepuasanA6', 'rataRataKepentinganA1', 'rataRataKepentinganA2', 'rataRataKepentinganA3', 'rataRataKepentinganA4', 'rataRataKepentinganA5', 'rataRataKepentinganA6', 'perkalianA1', 'perkalianA2', 'perkalianA3', 'perkalianA4', 'perkalianA5', 'perkalianA6'));
    }

    public function csi()
    {
        $hasil = $this->hasil();
        // dd($hasil);
        $t = $hasil->perkalianA1 + $hasil->perkalianA2 + $hasil->perkalianA3 + $hasil->perkalianA4 + $hasil->perkalianA5 + $hasil->perkalianA6;
        $y = $hasil->rataRataKepentinganA1 + $hasil->rataRataKepentinganA2 + $hasil->rataRataKepentinganA3 + $hasil->rataRataKepentinganA4 + $hasil->rataRataKepentinganA5 + $hasil->rataRataKepentinganA6;

        return view('kuesioner.csi', compact('t', 'y'));
    }

    public function saveKuesioner(Request $request)
    {
        $data = new Kuesioner();
        $data->nama = $request->input('nama');
        $data->kepuasan_1 = $request->input('kepuasan_1');
        $data->kepuasan_2 = $request->input('kepuasan_2');
        $data->kepuasan_3 = $request->input('kepuasan_3');
        $data->kepuasan_4 = $request->input('kepuasan_4');
        $data->kepuasan_5 = $request->input('kepuasan_5');
        $data->kepuasan_6 = $request->input('kepuasan_6');
        $data->kepentingan_1 = $request->input('kepentingan_1');
        $data->kepentingan_2 = $request->input('kepentingan_2');
        $data->kepentingan_3 = $request->input('kepentingan_3');
        $data->kepentingan_4 = $request->input('kepentingan_4');
        $data->kepentingan_5 = $request->input('kepentingan_5');
        $data->kepentingan_6 = $request->input('kepentingan_6');
        $data->save();

        return redirect('/dokterorder');
    }

    public function add(Request $request)
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

    public function excel(Request $request)
    {
        $tgl_skg = date('Y-m-d');
        $dari = date_create($request->input('dari'));
        $sampai = date_create($request->input('sampai'));
        $diff  = date_diff($dari, $sampai);
        $range_tgl = $diff->d + 1;

        if ($request->input('dari') <= $request->input('sampai')) {
            $data = DokterOrder::whereDate('belum_diproses', '>=', $request->input('dari') ?? $tgl_skg)
                ->whereDate('belum_diproses', '<=', $request->input('sampai') ?? $tgl_skg)
                ->latest('id')
                ->get();

            $tanggal = Carbon::parse($request->input('dari'))->isoFormat('DD MMMM YYYY') . ' - ' . Carbon::parse($request->input('sampai'))->isoFormat('DD MMMM YYYY');

            return Excel::download(new ExportMedok(
                $data,
                $tanggal
            ), 'Rekap MEDOK ' . $tanggal . '.xlsx');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tanggal tidak boleh Lebih kecil dari sebelumnya']);
        }
    }
}
