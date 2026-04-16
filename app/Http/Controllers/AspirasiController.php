<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard',[
            'total'=>Aspirasi::count(),
            'menunggu'=>Aspirasi::where('status','menunggu')->count(),
            'proses'=>Aspirasi::where('status','proses')->count(),
            'selesai'=>Aspirasi::where('status','selesai')->count(),
            'totalSiswa'=>User::where('role','siswa')->count(),
            'totalKategori'=>Kategori::count(),
            'latest'=>Aspirasi::with(['siswa','kategori'])
                        ->where('status','menunggu')->latest()->take(5)->get()
        ]);
    }

    public function siswaDashboard()
    {
        return view('siswa.dashboard',[
            'total'=>Aspirasi::where('siswa_id',Auth::id())->count(),
            'menunggu'=>Aspirasi::where('siswa_id',Auth::id())->where('status','menunggu')->count(),
            'proses'=>Aspirasi::where('siswa_id',Auth::id())->where('status','proses')->count(),
            'selesai'=>Aspirasi::where('siswa_id',Auth::id())->where('status','selesai')->count(),
            'aspirasis'=>Aspirasi::where('siswa_id',Auth::id())->latest()->get()
        ]);
    }

    public function create()
    {
        return view('siswa.input_aspirasi',[
            'kategoris'=>Kategori::orderBy('nama_kategori')->get()
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'judul_sarana'=>'required','kategori_id'=>'required',
            'foto'=>'required|image','lokasi'=>'required','keterangan'=>'required'
        ]);

        $foto=$r->file('foto')? $r->file('foto')->store('foto_aspirasi','public'):null;

        Aspirasi::create([
            'siswa_id'=>Auth::id(),
            'judul_sarana'=>$r->judul_sarana,
            'kategori_id'=>$r->kategori_id,
            'lokasi'=>$r->lokasi,
            'keterangan'=>$r->keterangan,
            'foto'=>$foto,
            'status'=>'menunggu'
        ]);

        return redirect('/history-aspirasi')->with('success','Aspirasi berhasil dikirim');
    }

    public function history()
    {
        return view('siswa.history',[
            'aspirasis'=>Aspirasi::with(['kategori','feedbacks'])
                        ->where('siswa_id',Auth::id())->latest()->get()
        ]);
    }

    public function dataAspirasi()
    {
        return view('admin.data_aspirasi',[
            'aspirasis'=>Aspirasi::with(['siswa','kategori'])->latest()->get()
        ]);
    }

    public function detailAspirasi(int $id)
    {
        return view('admin.detail_aspirasi',[
            'aspirasi'=>Aspirasi::with(['siswa','kategori','feedbacks'])->findOrFail($id)
        ]);
    }

    public function detailSiswa(int $id)
    {
        return view('siswa.show',[
            'aspirasi'=>Aspirasi::with(['kategori','feedbacks'])
                        ->where('siswa_id',Auth::id())->findOrFail($id)
        ]);
    }

    public function updateStatus(Request $r)
    {
        $r->validate([
            'id'=>'required',
            'status'=>'required|in:menunggu,proses,selesai',
            'feedback'=>'required'
        ]);

        $a=Aspirasi::findOrFail($r->id);
        $a->update(['status'=>$r->status]);

        Feedback::updateOrCreate(
            ['aspirasi_id'=>$a->id],
            ['admin_id'=>Auth::id(),'feedback'=>$r->feedback]
        );

        return redirect('/admin/aspirasi')->with('success','Berhasil update');
    }
}
