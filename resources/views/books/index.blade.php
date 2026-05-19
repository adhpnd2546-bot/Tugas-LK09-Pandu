@extends('layouts.app')

@section('title', 'Daftar Buku — Perpustakaan Digital')

@section('content')
    {{-- Hero Section --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Koleksi Buku</h1>
        <p class="text-slate-500 mt-1">Kelola dan jelajahi koleksi perpustakaan digital kamu</p>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('books.index') }}" class="mb-8">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all shadow-sm placeholder-slate-400">
            </div>
            <select name="category" onchange="this.form.submit()"
                class="px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all shadow-sm text-slate-600 min-w-[180px]">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-6 py-3 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                Cari
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('books.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium rounded-xl transition-colors text-center">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Book Grid --}}
    @if($books->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-slate-200/50 hover:-translate-y-1 transition-all duration-300 group">
                    {{-- Cover --}}
                    <a href="{{ route('books.show', $book) }}" class="block relative aspect-[3/4] overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span class="text-xs">Tanpa Cover</span>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="bg-white/90 backdrop-blur-sm text-xs font-semibold px-2.5 py-1 rounded-lg text-indigo-600 shadow-sm">{{ $book->category }}</span>
                        </div>
                    </a>

                    {{-- Info --}}
                    <div class="p-4">
                        <a href="{{ route('books.show', $book) }}" class="block">
                            <h3 class="font-bold text-slate-900 text-sm leading-snug line-clamp-2 group-hover:text-indigo-600 transition-colors">{{ $book->title }}</h3>
                        </a>
                        <p class="text-slate-500 text-xs mt-1">{{ $book->author }}</p>
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100">
                            <span class="text-xs text-slate-400">{{ $book->year }} &middot; {{ $book->publisher }}</span>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('books.edit', $book) }}" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $books->withQueryString()->links() }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum ada buku</h3>
            <p class="text-slate-400 text-sm mb-6">
                @if(request('search') || request('category'))
                    Tidak ditemukan buku yang cocok dengan pencarian.
                @else
                    Mulai tambahkan koleksi buku pertamamu.
                @endif
            </p>
            @if(request('search') || request('category'))
                <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Lihat semua buku
                </a>
            @else
                <a href="{{ route('books.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Tambah Buku Pertama
                </a>
            @endif
        </div>
    @endif
@endsection
