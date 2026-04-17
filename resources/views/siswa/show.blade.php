@extends('layouts.app')
@section('title','Detail Aspirasi')

@section('content')

<div class="min-h-screen bg-gray-100">

    <div class="bg-teal-500 text-white px-10 py-6 flex justify-between items-center">
        <a href="/history-aspirasi" class="flex items-center gap-2 font-medium">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="flex gap-8 text-sm font-medium">
            <span>Nama: {{ Auth::user()->name }}</span>
            <span>Kelas: {{ Auth::user()->kelas }}</span>
        </div>
    </div>

    <div class="flex justify-center mt-10">
    <div class="bg-white w-11/12 md:w-4/5 rounded-xl shadow p-8">

        <div class="flex gap-12 items-start">

            {{-- FOTO --}}
            <div style="width:160px">
                @if($aspirasi->foto)
                    <img src="{{ asset('storage/'.$aspirasi->foto) }}"
                         style="width:220px;height:140px;object-fit:cover;border-radius:8px">
                @else
                    <div style="width:160px;height:110px;background:#eee;display:flex;align-items:center;justify-content:center;font-size:12px">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            {{-- TABLE --}}
            <div style="flex:1">
                <table style="width:100%;border-collapse:collapse;font-size:14px">

                    @foreach([
                        'Tanggal Pengaduan'=>$aspirasi->created_at?->format('d M Y'),
                        'Tanggal Feedback'=>$aspirasi->updated_at?->format('d M Y'),
                        'Judul'=>$aspirasi->judul_sarana,
                        'Kategori'=>$aspirasi->kategori->nama_kategori ?? '-',
                        'Lokasi'=>$aspirasi->lokasi,
                        'Keterangan'=>$aspirasi->keterangan,
                        'Status'=>$aspirasi->status
                    ] as $k=>$v)
                    <tr>
                        <td style="padding:14px;border:1px solid #ddd;width:220px;font-weight:500">{{ $k }}</td>
                        <td style="padding:14px;border:1px solid #ddd">{{ $v }}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td style="padding:14px;border:1px solid #ddd;font-weight:500">Feedback</td>
                        <td style="padding:14px;border:1px solid #ddd">
                            @php $f = $aspirasi->feedbacks->last(); @endphp
                            {{ $f->feedback ?? 'Belum ada feedback' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
