<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>@yield('title') | LAPRAS</title>  

    @vite(['resources/css/app.css', 'resources/js/app.js'])  

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>  
  
<body class="bg-gray-100 min-h-screen">  
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
</body>  
</html>