<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title><script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

{{-- SIDEBAR --}}
</head>
    <body class="bg-gray-100">
        <div class="min-h-screen flex">
    <div class="w-64 bg-white shadow-md flex flex-col items-center pt-8">
    <img src="{{ asset('images/logo_LAPRAS.png') }}" class="w-45">
    <div class="w-full px-10 mt-10 space-y-8 text-[#17B3A6] font-medium">
        
        <a href="/admin/dashboard" class="flex items-center gap-2 hover:text-black">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
        <a href="/admin/aspirasi" class="flex items-center gap-2 hover:text-black">
            <i class="bi bi-chat-left-text"></i>
            Data Aspirasi
        </a>
        <a href="/admin/kategori" class="flex items-center gap-2 hover:text-black">
            <i class="bi bi-tags"></i>
            Kategori
        </a>
    </div>
</div>

<div class="flex-1 flex flex-col">

    {{-- TOPBAR --}}
    <div class="bg-[#17B3A6] text-white px-10 py-5 flex justify-between items-center">
        <h1 class="font-semibold text-lg">
            LAPRAS - Admin
        </h1>

        <form action="/logout" method="POST" id="logoutForm">
        @csrf
        <button type="button"
            onclick="confirmLogout()"
            class="bg-white text-gray-700 px-5 py-2 rounded-lg shadow text-sm flex items-center gap-2">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </button>
    </form>
    </div>

    <div class="p-8">
        @yield('content')
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
        toast:true,
        position:'top-end',
        icon:'success',
        title:'{{ session('success') }}',
        showConfirmButton:false,
        timer:2000
        })
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
        toast:true,
        position:'top-end',
        icon:'error',
        title:'{{ session('error') }}',
        showConfirmButton:false,
        timer:2000
        })
    </script>
    @endif

    <script>
        function confirmLogout(){
            Swal.fire({
            title:'Keluar dari akun?',
            text:'Apakah anda yakin ingin logout?',
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor:'#17B3A6',
            cancelButtonColor:'#d33',
            confirmButtonText:'Ya',
            cancelButtonText:'Batal'
            }).then((result)=>{

            if(result.isConfirmed){
            document.getElementById('logoutForm').submit()
            }
        })
    }
    </script>
    </div>
</div>
</div>
</body>
</html>