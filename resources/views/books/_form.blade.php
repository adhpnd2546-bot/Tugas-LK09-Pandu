{{-- Partial form — dipakai di create & edit --}}

{{-- Title --}}
<div>
    <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Buku <span class="text-red-400">*</span></label>
    <input type="text" name="title" id="title" value="{{ old('title', $book->title ?? '') }}" placeholder="Masukkan judul buku"
        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all @error('title') border-red-300 ring-1 ring-red-300 @enderror">
    @error('title')
        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
    @enderror
</div>

{{-- Author & Year --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="author" class="block text-sm font-semibold text-slate-700 mb-1.5">Penulis <span class="text-red-400">*</span></label>
        <input type="text" name="author" id="author" value="{{ old('author', $book->author ?? '') }}" placeholder="Nama penulis"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all @error('author') border-red-300 ring-1 ring-red-300 @enderror">
        @error('author')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="year" class="block text-sm font-semibold text-slate-700 mb-1.5">Tahun Terbit <span class="text-red-400">*</span></label>
        <input type="number" name="year" id="year" value="{{ old('year', $book->year ?? '') }}" placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') }}"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all @error('year') border-red-300 ring-1 ring-red-300 @enderror">
        @error('year')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Publisher & Category --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label for="publisher" class="block text-sm font-semibold text-slate-700 mb-1.5">Penerbit <span class="text-red-400">*</span></label>
        <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher ?? '') }}" placeholder="Nama penerbit"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all @error('publisher') border-red-300 ring-1 ring-red-300 @enderror">
        @error('publisher')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="category" class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori <span class="text-red-400">*</span></label>
        <input type="text" name="category" id="category" value="{{ old('category', $book->category ?? '') }}" placeholder="cth: Novel, Sains, Sejarah"
            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all @error('category') border-red-300 ring-1 ring-red-300 @enderror">
        @error('category')
            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Description --}}
<div>
    <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
    <textarea name="description" id="description" rows="4" placeholder="Sinopsis atau deskripsi buku (opsional)"
        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all resize-y @error('description') border-red-300 ring-1 ring-red-300 @enderror">{{ old('description', $book->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
    @enderror
</div>

{{-- Cover Upload --}}
<div>
    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Cover Buku</label>
    <div class="relative">
        <input type="file" name="cover" id="cover" accept="image/jpeg,image/png,image/jpg,image/webp"
            class="hidden" onchange="previewImage(event)">
        <label for="cover" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer hover:border-indigo-400 hover:bg-indigo-50/50 transition-all" id="upload-area">
            <div id="upload-placeholder" class="{{ isset($book) && $book->cover ? 'hidden' : '' }} flex flex-col items-center">
                <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm text-slate-500 font-medium">Klik untuk upload cover</span>
                <span class="text-xs text-slate-400 mt-1">JPEG, PNG, WebP — Maks 2MB</span>
            </div>
            <img id="preview-img" src="{{ isset($book) && $book->cover ? asset('storage/' . $book->cover) : '#' }}" alt="Preview"
                class="{{ isset($book) && $book->cover ? '' : 'hidden' }} w-full h-full object-contain rounded-xl p-2">
        </label>
    </div>
    @if(isset($book) && $book->cover)
        <p class="text-xs text-slate-400 mt-1.5">Cover saat ini sudah ada. Upload file baru untuk mengganti.</p>
    @endif
    @error('cover')
        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
    @enderror
</div>
