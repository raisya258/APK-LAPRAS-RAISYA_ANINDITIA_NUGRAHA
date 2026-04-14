@extends('layouts.admin')
@section('title','Detail Aspirasi')

@section('content')

<div class="pt-4 px-8 pb-8">

    <div class="bg-white rounded-xl shadow p-6">

        {{-- BACK --}}
        <a href="/admin/aspirasi" class="text-gray-600 mb-4 inline-block">
            ← Kembali
        </a>

        {{-- TABLE --}}
        <table class="w-full text-sm border border-gray-200">

            @foreach([
                'Tanggal'=>$aspirasi->created_at?->format('d M Y'),
                'Nama'=>$aspirasi->siswa->name ?? '-',
                'NIS'=>$aspirasi->siswa->username ?? '-',
                'Kelas'=>$aspirasi->siswa->kelas ?? '-',
                'Judul'=>$aspirasi->judul_sarana,
                'Kategori'=>$aspirasi->kategori->nama_kategori ?? '-',
                'Lokasi'=>$aspirasi->lokasi,
                'Keterangan'=>$aspirasi->keterangan
            ] as $k=>$v)

            <tr class="border border-gray-200 hover:bg-[#E6F7F5]">
                <td class="px-4 py-3 w-56 font-medium border border-gray-200">
                    {{ $k }}
                </td>
                <td class="px-4 py-3 border border-gray-200">
                    {{ $v }}
                </td>
            </tr>

            @endforeach

            {{-- FOTO --}}
            <tr class="border border-gray-200 hover:bg-[#E6F7F5]">
                <td class="px-4 py-3 font-medium border border-gray-200">
                    Foto
                </td>
                <td class="px-4 py-3 border border-gray-200">
                    @if($aspirasi->foto)
                        <img src="{{ asset('storage/'.$aspirasi->foto) }}"
                             style="width:160px;height:110px;object-fit:cover;border-radius:8px">
                    @else
                        <span class="text-gray-400 text-sm">Tidak ada</span>
                    @endif
                </td>
            </tr>

        </table>

        {{-- FORM --}}
        <form method="POST" action="/admin/aspirasi/update" class="mt-6">
            @csrf

            <input type="hidden" name="id" value="{{ $aspirasi->id }}">

            {{-- STATUS --}}
            <div class="mb-4">
                <label class="font-medium">Status</label>

                <select name="status"
                    class="w-full border border-gray-300 px-3 py-2 rounded 
                           focus:outline-none focus:ring-2 focus:ring-[#17B3A6]">

                    <option value="menunggu" {{ $aspirasi->status=='menunggu'?'selected':'' }}>
                        Menunggu
                    </option>
                    <option value="proses" {{ $aspirasi->status=='proses'?'selected':'' }}>
                        Proses
                    </option>
                    <option value="selesai" {{ $aspirasi->status=='selesai'?'selected':'' }}>
                        Selesai
                    </option>

                </select>
            </div>

            {{-- FEEDBACK --}}
            <div class="mb-4">
                <label class="font-medium">Feedback</label>

                <textarea name="feedback"
                    class="w-full border border-gray-300 px-3 py-2 rounded
                           focus:outline-none focus:ring-2 focus:ring-[#17B3A6]"
                    placeholder="Tulis tanggapan admin..."></textarea>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-between">
                <button type="reset"
                    class="bg-red-500 text-white px-4 py-2 rounded">
                    Batal
                </button>

                <button type="submit"
                    class="bg-[#17B3A6] hover:bg-[#139b90] text-white px-5 py-2 rounded">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection