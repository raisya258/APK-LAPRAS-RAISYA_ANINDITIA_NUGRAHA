@extends('layouts.admin')
@section('title','Data Aspirasi')

@section('content')

<div class="pt-4 px-8 pb-8">

    <h2 class="text-xl font-bold mb-6">Data Aspirasi</h2>

    <div class="bg-white rounded-xl shadow-sm p-6 overflow-x-auto">

        <table class="w-full text-sm border border-gray-200">

            <thead class="bg-[#E6F7F5] text-gray-700">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Tanggal</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">NIS</th>
                    <th class="border px-3 py-2">Kelas</th>
                    <th class="border px-3 py-2">Kategori</th>
                    <th class="border px-3 py-2">Lokasi</th>
                    <th class="border px-3 py-2">Foto</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($aspirasis as $a)

                @php
                    $color = match($a->status) {
                        'menunggu' => 'bg-yellow-100 text-yellow-600',
                        'proses' => 'bg-blue-100 text-blue-600',
                        'selesai' => 'bg-green-100 text-green-600',
                        default => ''
                    };
                @endphp

                <tr class="hover:bg-gray-50">

                    <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-3 py-2">{{ $a->created_at->format('d M Y') }}</td>
                    <td class="border px-3 py-2">{{ $a->siswa->name ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $a->siswa->username ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $a->siswa->kelas ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $a->kategori->nama_kategori ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $a->lokasi ?? '-' }}</td>

                    <td class="border px-3 py-2 text-center">
                        @if($a->foto)
                            <img src="{{ asset('storage/'.$a->foto) }}" class="w-16 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400 text-xs">Tidak ada</span>
                        @endif
                    </td>

                    <td class="border px-3 py-2">
                        <span class="px-2 py-1 text-xs rounded {{ $color }}">
                            {{ $a->status }}
                        </span>
                    </td>

                    <td class="border px-3 py-2 text-center">
                        <a href="/admin/aspirasi/{{ $a->id }}" class="text-blue-500 text-lg">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center py-6 text-gray-400">
                        Belum ada aspirasi
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
