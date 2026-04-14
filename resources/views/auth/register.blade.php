@extends('layouts.app')

@section('title','Register')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md text-center">

        <img src="{{ asset('images/logo_LAPRAS.png') }}" class="w-80 mx-auto mb-8">

        <div class="flex items-center mb-6">
            <div class="flex-1 h-px bg-[#17B3A6]"></div>
            <span class="mx-4 text-[#17B3A6] font-bold tracking-widest">DAFTAR AKUN</span>
            <div class="flex-1 h-px bg-[#17B3A6]"></div>
        </div>

        <form action="{{ route('register.proses') }}" method="POST" class="space-y-4">
            @csrf
            <div class="text-left">
                <input type="text" name="name" placeholder="Nama Lengkap"
                class="w-full px-4 py-3 border border-[#17B3A6] rounded-lg focus:ring-2 focus:ring-[#17B3A6] focus:outline-none">

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-left">
                <input type="text" name="username" placeholder="NIS"
                class="w-full px-4 py-3 border border-[#17B3A6] rounded-lg focus:ring-2 focus:ring-[#17B3A6] focus:outline-none">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-left">
                <select name="kelas"
                class="w-full px-4 py-3 border border-[#17B3A6] rounded-lg text-gray-500 focus:ring-2 focus:ring-[#17B3A6] focus:outline-none">
                    <option value="">Pilih Kelas</option>
                    <option value="XII RPL 1">XII RPL 1</option>
                    <option value="XII RPL 2">XII RPL 2</option>
                    <option value="XII RPL 3">XII RPL 3</option>
                </select>

                @error('kelas')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-left relative">
                <input type="password" name="password" id="password" placeholder="Password"
                class="w-full px-4 py-3 border border-[#17B3A6] rounded-lg focus:ring-2 focus:ring-[#17B3A6] focus:outline-none">

                <button type="button"
                    onclick="togglePassword()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">

                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#17B3A6] hover:bg-[#149e93] text-white py-3 rounded-lg font-semibold">
                DAFTAR
            </button>
        </form>

        <p class="mt-6 text-sm">
            Sudah punya akun?
            <a href="/login" class="text-blue-600 font-semibold hover:underline">Login</a>
        </p>

        <a href="/" class="inline-flex items-center gap-2 mt-6 text-blue-600 hover:text-blue-800 text-sm font-medium">
            <i class="bi bi-arrow-left"></i>
            Kembali ke halaman utama
        </a>
    </div>
</div>

<script>
    function togglePassword(){

        let input = document.getElementById("password")
        let icon  = document.getElementById("eyeIcon")

        if(input.type === "password"){
            input.type = "text"
            icon.classList.replace("bi-eye","bi-eye-slash")
        }else{
            input.type = "password"
            icon.classList.replace("bi-eye-slash","bi-eye")
        }
    }
</script>
@endsection