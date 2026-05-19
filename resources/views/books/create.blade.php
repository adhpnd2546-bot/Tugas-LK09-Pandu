@extends('layouts.app')

@section('title', 'Tambah Buku — Perpustakaan Digital')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('books.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold text-slate-900">Tambah Buku Baru</h1>
            <p class="text-slate-500 mt-1 text-sm">Isi form di bawah untuk menambahkan buku ke koleksi</p>
        </div>

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            @csrf
            @include('books._form')

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="flex-1 sm:flex-none bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition-all text-sm">
                    Simpan Buku
                </button>
                <a href="{{ route('books.index') }}" class="px-6 py-3 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors text-sm font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('preview-img').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
