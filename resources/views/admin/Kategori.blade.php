@extends('layouts.admin')
@section('title','Kategori')

@section('content')

<div class="pt-4 px-8 pb-8">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h2>
            <p class="text-gray-500 text-base">Kelola kategori dalam sistem</p>
        </div>

        <button onclick="toggle('modalTambah',true)"
            class="bg-[#17B3A6] text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
            <i class="bi bi-plus-lg"></i>Tambah Kategori
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm">

        <div class="p-5">
            <div class="relative w-64">
                <input id="searchInput" placeholder="Cari kategori..."
                    class="w-full bg-gray-100 border border-gray-200 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-2 focus:ring-[#17B3A6] focus:border-[#17B3A6] focus:outline-none">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
            </div>
        </div>

        <div class="px-6 pb-6">

            <table id="tableKategori" class="w-full text-sm border border-gray-200">

                <thead class="bg-[#E6F7F5]">
                    <tr>
                        <th class="px-4 py-3 border text-center w-16">No</th>
                        <th class="px-4 py-3 border text-left">Nama Kategori</th>
                        <th class="px-4 py-3 border text-center w-28">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kategoris as $k)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border text-center nomor"></td>
                        <td class="px-4 py-3 border">
                            {{ $k->nama_kategori }}
                        </td>
                        <td class="px-4 py-3 border text-center">

                            <button onclick="openEdit({{ $k->id }}, '{{ $k->nama_kategori }}')"
                                class="text-blue-500 mr-2">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <form id="del{{ $k->id }}"
                                action="/admin/kategori/{{ $k->id }}"
                                method="POST"
                                class="inline">

                                @csrf
                                @method('DELETE')

                                <button type="button"
                                    onclick="confirmDelete({{ $k->id }})"
                                    class="text-red-500">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="3" class="text-center py-8 text-gray-400 border">
                            Belum ada kategori
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalTambah" class="hidden fixed inset-0 bg-black/40 items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-80">
        <h3 class="font-semibold mb-4">Tambah Kategori</h3>

        <form method="POST" action="/admin/kategori">
            @csrf

            <input name="nama_kategori" required
                class="w-full border border-gray-300 rounded-lg p-2 mb-4 focus:ring-2 focus:ring-[#17B3A6] focus:border-[#17B3A6] focus:outline-none">

            <div class="text-right space-x-2">
                <button type="button" onclick="toggle('modalTambah',false)">Batal</button>
                <button class="bg-[#17B3A6] text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>


<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 items-center justify-center">
    <div class="bg-white p-6 rounded-xl w-80">

        <h3 class="font-semibold mb-4">Edit Kategori</h3>

        <form method="POST" id="formEdit">
            @csrf
            @method('PUT')

            <input id="editNama" name="nama_kategori" required
                class="w-full border border-gray-300 rounded-lg p-2 mb-4 focus:ring-2 focus:ring-[#17B3A6] focus:border-[#17B3A6] focus:outline-none">

            <div class="text-right space-x-2">
                <button type="button" onclick="toggle('modalEdit',false)">Batal</button>
                <button class="bg-[#17B3A6] text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggle(id,show){
    const el=document.getElementById(id)
    show?(el.classList.remove('hidden'),el.classList.add('flex'))
        :(el.classList.add('hidden'),el.classList.remove('flex'))
}

function openEdit(id,nama){
    formEdit.action='/admin/kategori/'+id
    editNama.value=nama
    toggle('modalEdit',true)
}

function confirmDelete(id){
    Swal.fire({
        title:'Hapus kategori?',
        text:'Data kategori akan dihapus',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#17B3A6',
        cancelButtonColor:'#d33',
        confirmButtonText:'Ya',
        cancelButtonText:'Batal'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('del'+id).submit()
        }
    })
}

document.querySelectorAll('#tableKategori tbody tr')
.forEach((tr,i)=>{
    let n=tr.querySelector('.nomor')
    if(n) n.innerText=i+1
})

searchInput.onkeyup=e=>{
    let v=e.target.value.toLowerCase()
    document.querySelectorAll('#tableKategori tbody tr')
    .forEach(tr=>{
        tr.style.display = tr.innerText.toLowerCase().includes(v)?'':'none'
    })
}
</script>
@endsection