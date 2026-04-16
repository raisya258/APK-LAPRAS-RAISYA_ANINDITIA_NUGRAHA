@extends('layouts.admin')
@section('title','Dashboard Admin')
@section('content')

<div class="space-y-8">
    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Hallo, Selamat Datang
        </h2>

        <p class="text-gray-500 text-sm">
            Anda login sebagai admin, silahkan kelola data aspirasi siswa
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Aspirasi</p>
                <h2 class="text-2xl font-bold">{{ $total }}</h2>
            </div>
            <i class="bi bi-chat-square-text text-3xl text-[#17B3A6]"></i>
        </div>

        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Siswa</p>
                <h2 class="text-2xl font-bold">{{ $totalSiswa }}</h2>
            </div>
            <i class="bi bi-people text-3xl text-blue-500"></i>
        </div>

        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Kategori</p>
                <h2 class="text-2xl font-bold">{{ $totalKategori }}</h2>
            </div>
            <i class="bi bi-tags text-3xl text-purple-500"></i>
        </div>

        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Menunggu</p>
                <h2 class="text-xl font-bold text-yellow-500">{{ $menunggu }}</h2>
            </div>
            <i class="bi bi-hourglass text-3xl text-yellow-500"></i>
        </div>

        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Diproses</p>
                <h2 class="text-xl font-bold text-blue-500">{{ $proses }}</h2>
            </div>
            <i class="bi bi-gear text-3xl text-blue-500"></i>
        </div>

        <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Selesai</p>
                <h2 class="text-xl font-bold text-green-500">{{ $selesai }}</h2>
            </div>
            <i class="bi bi-check-circle text-3xl text-green-500"></i>
        </div>
    </div>

    {{-- TABEL ASPIRASI --}}
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-xl font-bold mb-6 text-gray-700">
            Aspirasi Terbaru
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-300">

                <thead class="bg-[#E6F7F5] text-gray-700">
                    <tr>
                        <th class="py-3 px-3 border border-gray-300 text-left">No</th>
                        <th class="px-3 border border-gray-300 text-left">Tanggal</th>
                        <th class="px-3 border border-gray-300 text-left">Nama</th>
                        <th class="px-3 border border-gray-300 text-left">Kelas</th>
                        <th class="px-3 border border-gray-300 text-left">Kategori</th>
                        <th class="px-3 border border-gray-300 text-left">Lokasi</th>
                        <th class="px-3 border border-gray-300 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($latest as $a)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-3 border border-gray-300">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-3 border border-gray-300">
                            {{ $a->created_at->format('d M Y') }}
                        </td>

                        <td class="px-3 border border-gray-300">
                            {{ $a->siswa->name ?? '-' }}
                        </td>

                        <td class="px-3 border border-gray-300">
                            {{ $a->siswa->kelas ?? '-' }}
                        </td>

                        <td class="px-3 border border-gray-300">
                            {{ $a->kategori->nama_kategori ?? '-' }}
                        </td>

                        <td class="px-3 border border-gray-300">
                            {{ $a->lokasi ?? '-' }}
                        </td>

                        <td class="px-3 border border-gray-300">
                            @if($a->status=='menunggu')
                                <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-600 font-semibold">
                                    Menunggu
                                </span>
                            @elseif($a->status=='diproses')
                                <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-600 font-semibold">
                                    Diproses
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-600 font-semibold">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400 border border-gray-300">
                            Belum ada aspirasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
