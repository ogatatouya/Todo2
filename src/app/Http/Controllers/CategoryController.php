<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 一覧表示
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }

    // 作成
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'カテゴリを作成しました');
    }

    // 更新
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'カテゴリを更新しました');
    }

    // 削除
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('message', 'カテゴリを削除しました');
    }
}