<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request): Response
    {
        $query = Article::query()->orderBy('sort_order')->latest('published_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $isPublished = $request->status === 'published';
            $query->where('is_published', $isPublished);
        }

        $articles = $query->paginate(15)->withQueryString();

        $categories = Article::distinct()->pluck('category')->filter()->values();

        $counts = [
            'all' => Article::count(),
            'published' => Article::where('is_published', true)->count(),
            'draft' => Article::where('is_published', false)->count(),
        ];

        return Inertia::render('Admin/Articles/Index', [
            'articles' => $articles,
            'categories' => $categories,
            'counts' => $counts,
            'filters' => $request->only(['search', 'category', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new article.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Articles/Form', [
            'article' => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:1000',
            'read_time' => 'nullable|string|max:50',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (Article::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        if (empty($validated['read_time'])) {
            $words = str_word_count(strip_tags($validated['content']));
            $minutes = max(1, (int) ceil($words / 180));
            $validated['read_time'] = "{$minutes} menit baca";
        }

        if (empty($validated['author'])) {
            $validated['author'] = 'Tim Swift Code';
        }

        if (empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article): Response
    {
        return Inertia::render('Admin/Articles/Form', [
            'article' => $article,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($article->id)],
            'category' => 'required|string|max:100',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:1000',
            'read_time' => 'nullable|string|max:50',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        if (empty($validated['read_time'])) {
            $words = str_word_count(strip_tags($validated['content']));
            $minutes = max(1, (int) ceil($words / 180));
            $validated['read_time'] = "{$minutes} menit baca";
        }

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['sort_order'] = $validated['sort_order'] ?? $article->sort_order;

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
