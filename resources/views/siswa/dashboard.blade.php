@extends('layouts.app')
@section('title','Dashboard Siswa')

@section('content')
<div class="min-h-screen bg-gray-100">

    <!-- NAV -->
    <div class="bg-teal-500 text-white px-8 py-4 flex justify-between items-center">
        <h1 class="font-semibold text-lg">LAPRAS - Siswa</h1>
        <form action="/logout" method="POST" id="logoutForm">
            @csrf
            <button type="button" onclick="confirmLogout()"
                class="bg-white text-gray-700 px-4 py-2 rounded-lg shadow flex items-center gap-2">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <div class="px-10 py-8">

        <!-- HEADER -->
        <h2 class="text-2xl font-bold mb-1">Hallo, {{ Auth::user()->name }}</h2>
        <p class="text-gray-500 text-sm mb-6">Pantau status aspirasi kamu</p>

        <!-- IDENTITAS -->
        <div class="bg-white p-5 rounded-xl shadow mb-8 flex gap-12">
            <div><p class="text-gray-500 text-sm">Nama</p><p class="font-semibold">{{ Auth::user()->name }}</p></div>
            <div><p class="text-gray-500 text-sm">NIS</p><p class="font-semibold">{{ Auth::user()->username }}</p></div>
            <div><p class="text-gray-500 text-sm">Kelas</p><p class="font-semibold">{{ Auth::user()->kelas }}</p></div>
        </div>

        <!-- STAT -->
        <div class="grid grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow flex justify-between items-center">
                <div><p class="text-gray-500 text-sm">Total</p><p class="text-2xl font-bold">{{ $total }}</p></div>
                <i class="bi bi-chat-dots text-teal-400 text-2xl"></i>
            </div>
            <div class="bg-white p-6 rounded-xl shadow flex justify-between items-center">
                <div><p class="text-gray-500 text-sm">Menunggu</p><p class="text-2xl font-bold text-yellow-500">{{ $menunggu }}</p></div>
                <i class="bi bi-hourglass text-yellow-400 text-2xl"></i>
            </div>
            <div class="bg-white p-6 rounded-xl shadow flex justify-between items-center">
                <div><p class="text-gray-500 text-sm">Diproses</p><p class="text-2xl font-bold text-blue-500">{{ $proses }}</p></div>
                <i class="bi bi-gear text-blue-400 text-2xl"></i>
            </div>
            <div class="bg-white p-6 rounded-xl shadow flex justify-between items-center">
                <div><p class="text-gray-500 text-sm">Selesai</p><p class="text-2xl font-bold text-green-500">{{ $selesai }}</p></div>
                <i class="bi bi-check-circle text-green-400 text-2xl"></i>
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex gap-4 mb-6">
            <a href="/input-aspirasi" class="bg-teal-500 text-white px-6 py-3 rounded-lg flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Buat Aspirasi
            </a>
            <a href="/history-aspirasi" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg flex items-center gap-2">
                <i class="bi bi-clock-history"></i> History Aspirasi
            </a>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-4">Aspirasi Menunggu</h3>

            <table class="w-full text-sm border border-gray-200">
                <thead class="bg-[#E6F7F5]">
                    <tr>
                        <th class="border border-gray-200 px-3 py-2">No</th>
                        <th class="border border-gray-200 px-3 py-2">Tanggal</th>
                        <th class="border border-gray-200 px-3 py-2">Kategori</th>
                        <th class="border border-gray-200 px-3 py-2">Lokasi</th>
                        <th class="border border-gray-200 px-3 py-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($aspirasis->where('status','menunggu') as $a)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-200 px-3 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $a->created_at->format('d M Y') }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $a->kategori->nama_kategori ?? '-' }}</td>
                        <td class="border border-gray-200 px-3 py-2">{{ $a->lokasi }}</td>
                        <td class="border border-gray-200 px-3 py-2">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs">menunggu</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-400">Tidak ada data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection