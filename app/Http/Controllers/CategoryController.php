<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->paginate(5);

        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->all();
        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success','Kategorija sėkmingai pridėta');
    }

    public function show(Category $category): View
    {
        return view('categories.show',compact('category'));
    }


    public function edit(Category $category): View
    {
        return view('categories.edit',compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success','Kategorija sėkmingai redaguota');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success','Kategorija sėkmingai ištrinta');
    }
}
