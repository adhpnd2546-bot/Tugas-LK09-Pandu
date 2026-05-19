<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Tampilkan daftar buku dengan search & filter.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // Search judul atau penulis
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $books = $query->latest()->paginate(12);
        $categories = Book::select('category')->distinct()->pluck('category');

        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Form tambah buku baru.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Simpan buku baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'required|string|max:255',
            'year'        => 'required|integer|min:1900|max:' . date('Y'),
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail satu buku.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Form edit buku.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update data buku.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'publisher'   => 'required|string|max:255',
            'year'        => 'required|integer|min:1900|max:' . date('Y'),
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'cover'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Kalau ada cover baru, hapus yang lama lalu simpan yang baru
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $book->update($validated);

        return redirect()->route('books.show', $book)
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Hapus buku dari database.
     */
    public function destroy(Book $book)
    {
        // Hapus file cover kalau ada
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
