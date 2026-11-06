<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'author'])->orderByDesc('dt_created')->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    public function admin()
    {
        $blogs = Blog::with('category')->orderByDesc('dt_created')->paginate(10);
        return view('blog.admin', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create', [
            'categories' => Category::orderBy('category_name')->pluck('category_name', 'category_id'),
        ]);
    }

    public function store(BlogRequest $request)
    {
        $blog = Blog::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('blog.show', $blog);
    }

    // Перегляд одного запису
    public function show(Blog $blog)
    {
        // Завдяки Route Model Binding, Laravel сам знайде запис за blog_id
        return view('blog.show', compact('blog'));
    }

    // Форма редагування
    public function edit(Blog $blog)
    {
        return view('blog.edit', [
            'blog' => $blog,
            // Передаємо категорії для випадаючого списку так само, як і у create()
            'categories' => Category::orderBy('category_name')->pluck('category_name', 'category_id'),
        ]);
    }

    // Збереження змін
    public function update(BlogRequest $request, Blog $blog)
    {
        // Оновлюємо лише валідовані дані
        $blog->update($request->validated());

        return redirect()->route('blog.show', $blog);
    }

    // Видалення запису
    public function destroy(Blog $blog)
    {
        $blog->delete();

        // Повертаємо в адмінку, бо звідти найчастіше видаляють
        return redirect()->route('blog.admin');
    }
}
