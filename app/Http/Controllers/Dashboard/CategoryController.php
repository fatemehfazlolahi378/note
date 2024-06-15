<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desktop\Category\CategoryStoreRequest;
use App\Http\Requests\Desktop\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class CategoryController extends Controller
{
    protected Category $category;
    protected Tag $tag;
    public function __construct(Category $category , Tag $tag)
    {
        $this->category = $category;
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->category->whereUserId(auth()->id())->orderBy('name')->paginate($this->perPage());
        return view('dashboard.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->whereUserId(auth()->id())->get();
        $tags = $this->tag->get();
        return view('dashboard.category.create' , compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $this->category->name = $request->get('name');
            $this->category->slug = \Str::lower(str_replace(' ', '-', $request->get('slug')));
            $this->category->icon = $request->get('icon');
            $this->category->parent_id = $request->get('parent_id');
            $this->category->user_id = auth()->id();
            $this->category->save();

            if($request->has('tags')){
                $this->category->tags()->attach($request->get('tags'));
            }
            DB::commit();
        }catch (Exception $e){
            report($e);
            DB::rollback();
            return response()->json(['title' => 'دسته بندی', 'message' => ' ثبت نشد.'], 500);
        }
        toast('دسته با موفقیت ثبت شد','success');
        return redirect()->route('dashboard.categories.index');

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
        $categories = $this->category->whereUserId(auth()->id())->get();
        $tags = $this->tag->get();
        return view('dashboard.category.edit', compact('category' , 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request , Category $category)
    {
        try {
            $category->name = $request->get('name');
            $category->slug = \Str::lower(str_replace(' ', '-', $request->get('slug')));
            $category->icon = $request->get('icon');
            $category->parent_id = $request->get('parent_id');
            $category->save();
            if($request->has('tags')){
                $category->tags()->sync($request->get('tags'));
            }

        }catch (Exception $e){
            report($e);
            DB::rollback();
            return response()->json(['title' => 'دسته بندی', 'message' => ' ثبت نشد.'], 500);
        }

        toast('دسته با موفقیت ویرایش شد','success');

        return redirect()->route('dashboard.categories.index');
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

    /**
     * get subcategory
     */
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

    /**
     * list category dropdown
     */

    public function list()
    {
        $categories = $this->category->whereParentId(0)->whereUserId(auth()->id())->get();
        return view('dashboard.category.list' , compact('categories'));
    }

}
