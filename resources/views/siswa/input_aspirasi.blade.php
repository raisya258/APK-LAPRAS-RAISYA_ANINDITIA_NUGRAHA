@extends('layouts.app')
@section('title','Input Aspirasi')

@section('content')

<div class="min-h-screen bg-gray-100">

    {{-- NAVBAR --}}
    <div class="bg-teal-500 text-white px-10 py-6 flex justify-between">

        <a href="/siswa/dashboard" class="flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <div class="flex gap-8 text-sm">
            <span>Nama: {{ Auth::user()->name }}</span>
            <span>Kelas: {{ Auth::user()->kelas }}</span>
        </div>
    </div>

    {{-- FORM --}}
    <div class="flex justify-center mt-10">
        <div class="bg-white w-2/3 rounded-3xl shadow-xl p-10">
            <h2 class="text-2xl font-bold mb-8 text-gray-800">
                Form Aspirasi Siswa
            </h2>
            <form action="/input-aspirasi" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- JUDUL LAPORAN --}}
                <div class="mb-6">
                    <label class="block font-medium mb-2">
                        Judul Laporan <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="judul_sarana"
                        value="{{ old('judul_sarana') }}"
                        class="w-full border border-gray-300 rounded-xl p-3
                        focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    @error('judul_sarana')
                        <p class="text-red-500 text-sm mt-1">Judul wajib diisi</p>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block font-medium mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="kategori_id"
                            class="w-full border border-gray-300 rounded-xl p-3
                            focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="text-red-500 text-sm mt-1">Kategori wajib diisi</p>
                        @enderror
                    </div>

                    {{-- LOKASI --}}
                    <div>
                        <label class="block font-medium mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi') }}"
                            class="w-full border border-gray-300 rounded-xl p-3
                            focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        @error('lokasi')
                            <p class="text-red-500 text-sm mt-1">Lokasi wajib diisi</p>
                        @enderror
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-8">
                    <label class="block font-medium mb-2">
                        Deskripsi Aspirasi <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        name="keterangan"
                        rows="4"
                        class="w-full border border-gray-300 rounded-xl p-3
                        focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">Deskripsi wajib diisi</p>
                    @enderror
                </div>

                {{-- FOTO --}}
                <div class="mb-8">
                    <label class="block font-medium mb-2">
                        Upload Foto <span class="text-red-500">*</span>
                    </label>

                    <label class="w-full flex flex-col items-center justify-center
                                   border border-dashed border-gray-300
                                   rounded-2xl py-14 cursor-pointer
                                   hover:border-teal-500">

                        <p class="text-teal-600 font-semibold">
                            Upload file
                        </p>

                        <p class="text-sm text-gray-400">
                            PNG JPG JPEG max 2MB
                        </p>

                        <input
                            type="file"
                            name="foto"
                            class="hidden"
                            accept="image/*">
                    </label>

                    @error('foto')
                        <p class="text-red-500 text-sm mt-1">Foto wajib diupload</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-between">
                    <button
                        type="reset"
                        class="bg-red-500 text-white px-6 py-2 rounded-xl hover:bg-red-600">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="bg-teal-500 text-white px-8 py-2 rounded-xl hover:bg-teal-600">
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection