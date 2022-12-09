<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:categories-read'])->only('index');
        $this->middleware(['permission:categories-create'])->only(['create', 'store']);
        $this->middleware(['permission:categories-update'])->only(['edit', 'update']);
        $this->middleware(['permission:categories-delete'])->only('destroy');
    } //end of constructor


    public function index()
    {
        $categories = Category::withCount('movies')->latest()->paginate(9);
        return view('categories.index', compact('categories'));
    } //end of index



    public function create()
    {
        return view('categories.create');
    } //end of create



    public function store(StoreCategoryRequest $request)
    {
        $categories_data = $request->all();
        $categories_data['user_id'] = Auth::id();
        Category::create($categories_data);
        return redirect()->route('categories.index');
    } //end of store



    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    } //end of edit



    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $categories_data = $request->all();
        $categories_data['user_id'] = Auth::id();
        $category->update($categories_data);
        return redirect()->route('categories.index');
    } //end of update



    public function destroy(Category $category)
    {
        $category->movies()->detach();
        $category->delete();
        return redirect()->route('categories.index');
    } //end of destroy
}
