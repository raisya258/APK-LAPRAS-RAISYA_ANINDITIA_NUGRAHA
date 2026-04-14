<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $r)
    {
        $kategoris = Kategori::when($r->search,
            fn($q,$s)=>$q->where('nama_kategori','like',"%$s%"))
            ->latest()
            ->paginate(5);

        return view('admin.kategori',compact('kategoris'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama_kategori'=>'required'
        ]);

        Kategori::create([
            'nama_kategori'=>$r->nama_kategori
        ]);

        return back()->with('success','Kategori berhasil ditambah');
    }

    public function update(Request $r,$id)
    {
        $r->validate([
            'nama_kategori'=>'required'
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori'=>$r->nama_kategori
        ]);

        return back()->with('success','Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        if($kategori->aspirasis()->count() > 0){
            return back()->with('error','Kategori masih digunakan oleh aspirasi');
        }

        $kategori->delete();

        return back()->with('success','Kategori berhasil dihapus');
    }
}