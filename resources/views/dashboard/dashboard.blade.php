<x-app-layout>
    
    <x-slot name="title">{{ $title }}</x-slot>
    
    <div class="bg-blue-500 p-8 rounded-2xl text-white">
        <h1 class="dashboard-title">Selamat Datang {{ Auth::user()->name }} 👋</h1>
        <p class="mt-2 text-blue-100">Ini adalah halaman dashboard dari website Himpunan Mahasiswa Teknik Informatika Universitas Muhammadiyah Riau</p>
    </div>

</x-app-layout>
