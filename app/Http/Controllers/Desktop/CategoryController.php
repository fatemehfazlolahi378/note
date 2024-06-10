<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desktop\Category\CategoryStoreRequest;
use App\Http\Requests\Desktop\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected Category $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->category->orderBy('name')->paginate($this->perPage());
        return view('desktop.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->get();
        return view('desktop.category.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $this->category->name = $request->get('name');
        $this->category->slug = \Str::lower(str_replace(' ', '-', $request->get('slug')));
        $this->category->icon = $request->get('icon');
        $this->category->parent_id = $request->get('parent_id');
        $this->category->save();

        toast('دسته با موفقیت ثبت شد','success');

        return redirect()->route('desktop.categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = $this->category->get();
        return view('desktop.category.edit', compact('category' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request , Category $category)
    {
        $category->name = $request->get('name');
        $category->slug = \Str::lower(str_replace(' ', '-', $request->get('slug')));
        $category->icon = $request->get('icon');
        $category->parent_id = $request->get('parent_id');
        $category->save();

        toast('دسته با موفقیت ویرایش شد','success');

        return redirect()->route('desktop.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->children->count() > 0) {
            return response()->json(['title' => 'خطا', 'message' => 'دسته اصلی قابلیت حذف ندارد.'], 403);
        }

        if ($category->notes->count() > 0) {
            return response()->json(['title' => 'خطا', 'message' => 'برای این دسته یادداشت ثبت شده و قابلیت حذف ندارد.'], 403);
        }
        $category->delete();
        return response()->json('دسته مورد نظر با موفقیت حذف شد', 200);
    }

    public function getSubCat($id)
    {
        if (\request()->ajax()) {
            $category = Category::whereId($id)->firstOrFail();
            $categories = $category->children()->select(['categories.name', 'categories.slug', 'categories.id'])->get();
            if ($category->children->count() === 0) {
                return response()->json(['categories' => []]);
            }
            return response()->json(['categories' => $categories]);
        }
        return redirect(url('/'));
    }
}
