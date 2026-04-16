@extends('layouts.app')

@section('title','Landing Page')

@section('content')

<div class="min-h-screen flex items-center bg-gray-100">

    <div class="container mx-auto px-20 flex justify-between items-center">

        <div class="max-w-2xl">

            <img src="{{ asset('images/logo_LAPRAS.png') }}"
                 class="w-85 mb-10">

            <h1 class="text-5xl font-bold mb-8 leading-tight">
                Sistem pengaduan <br>
                sarana prasarana <br>
                sekolah
            </h1>

            <p class="text-gray-600 mb-10 text-xl">
                LAPRAS hadir sebagai solusi digital untuk
                pelaporan masalah sarana prasarana sekolah.
            </p>

            <div class="flex gap-6">

                <a href="/login"
                   class="bg-teal-500 hover:bg-teal-600 text-white px-10 py-5 text-xl rounded-xl flex items-center gap-3">
                    <i class="bi bi-box-arrow-in-right text-2xl"></i>
                    Masuk
                </a>

                <a href="/register"
                   class="border-2 border-teal-500 text-teal-500 px-10 py-5 text-xl rounded-xl flex items-center gap-3 hover:bg-teal-50">
                    <i class="bi bi-person-plus text-2xl"></i>
                    Daftar
                </a>
            </div>
        </div>

        <div class="text-center max-w-sm">

            <img src="{{ asset('images/pesan.png') }}"
                 class="w-75 mb-6">

            <h3 class="font-semibold text-2xl mb-2">
                Pengaduan | Umpan balik | Progres
            </h3>

            <p class="text-gray-500 text-lg">
                Setiap laporan akan diproses dan ditindak
                lanjuti oleh pihak sekolah.
            </p>
        </div>
    </div>
</div>
@endsection
