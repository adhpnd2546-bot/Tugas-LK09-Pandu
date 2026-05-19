@extends('layouts.app')

@section('title', $book->title . ' — Perpustakaan Digital')

@section('content')
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('books.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke daftar
        </a>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="flex flex-col md:flex-row">
                {{-- Cover --}}
                <div class="md:w-80 shrink-0 bg-gradient-to-br from-slate-100 to-slate-200">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover min-h-[300px] md:min-h-full">
                    @else
                        <div class="w-full h-full min-h-[300px] flex flex-col items-center justify-center text-slate-300">
                            <svg class="w-20 h-20 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="text-sm">Tanpa Cover</span>
                        </div>
                    @endif
                </div>

                {{-- Detail --}}
                <div class="flex-1 p-6 sm:p-8">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div>
                            <span class="inline-block bg-indigo-50 text-indigo-600 text-xs font-semibold px-3 py-1 rounded-lg mb-3">{{ $book->category }}</span>
                            <h1 class="text-2xl font-bold text-slate-900 leading-tight">{{ $book->title }}</h1>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Penulis</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $book->author }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Penerbit</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $book->publisher }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400">Tahun Terbit</p>
                                <p class="text-sm font-semibold text-slate-800">{{ $book->year }}</p>
                            </div>
                        </div>
                    </div>

                    @if($book->description)
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-slate-700 mb-2">Deskripsi</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap items-center gap-3 pt-6 border-t border-slate-100">
                        <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center gap-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit
                        </a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
