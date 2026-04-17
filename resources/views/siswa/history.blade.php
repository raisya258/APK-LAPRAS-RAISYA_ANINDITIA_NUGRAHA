@extends('layouts.app')
@section('title','History Aspirasi')

@section('content')

<div class="min-h-screen bg-gray-100">

    <div class="bg-teal-500 text-white px-10 py-6 flex justify-between items-center">
        <a href="/siswa/dashboard" class="flex items-center gap-2 font-medium">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="flex gap-8 text-sm font-medium">
            <span>Nama: {{ Auth::user()->name }}</span>
            <span>Kelas: {{ Auth::user()->kelas }}</span>
        </div>
    </div>

    <div class="flex justify-center mt-10">

        <div class="bg-white w-11/12 md:w-5/6 rounded-2xl shadow-lg p-8">

            <h2 class="text-xl font-bold mb-6 text-gray-700">
                History Aspirasi
            </h2>

            <div class="overflow-x-auto">

                <table class="w-full text-sm border border-gray-200">

                    <thead class="bg-[#E6F7F5] text-gray-700">
                        <tr>
                            <th class="px-4 py-3 border border-gray-200">No</th>
                            <th class="px-4 py-3 border border-gray-200">Tanggal</th>
                            <th class="px-4 py-3 border border-gray-200">Foto</th>
                            <th class="px-4 py-3 border border-gray-200">Judul</th>
                            <th class="px-4 py-3 border border-gray-200">Kategori</th>
                            <th class="px-4 py-3 border border-gray-200">Lokasi</th>
                            <th class="px-4 py-3 border border-gray-200">Status</th>
                            <th class="px-4 py-3 border border-gray-200 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($aspirasis as $a)

                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3 border border-gray-200">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3 border border-gray-200">
                                @if($a->updated_at > $a->created_at)
                                {{ $a->updated_at?->format('d M Y') }}
                                @else
                                {{ $a->created_at?->format('d M Y') }}
                                @endif
                            </td>

                            <td class="px-4 py-3 border border-gray-200">
                                @if($a->foto)
                                    <img src="{{ asset('storage/'.$a->foto) }}"
                                         class="w-24 h-16 object-cover rounded shadow">
                                @else
                                    <span class="text-gray-400 text-xs">Tidak ada</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 border border-gray-200">
                                {{ $a->judul_sarana ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border border-gray-200">
                                {{ $a->kategori->nama_kategori ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border border-gray-200">
                                {{ $a->lokasi ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border border-gray-200">

                                @php
                                    $color = match($a->status){
                                        'menunggu'=>'bg-yellow-100 text-yellow-600',
                                        'proses'=>'bg-blue-100 text-blue-600',
                                        'selesai'=>'bg-green-100 text-green-600'
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs {{ $color }}">
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 border border-gray-200 text-center">
                                <a href="/siswa/aspirasi/{{ $a->id }}"
                                   class="text-blue-500 text-lg">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty

                        <tr>
                            <td colspan="8"
                                class="text-center py-10 text-gray-400 border border-gray-200">
                                Belum ada aspirasi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
