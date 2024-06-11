<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desktop\Tag\TagStoreRequest;
use App\Http\Requests\Desktop\Tag\TagUpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected Tag $tag;
    public function __construct(Tag $tag)
    {
       $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tag->paginate($this->perPage());
        return view('desktop.tag.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('desktop.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        $this->tag->name = $request->get('name');
        $this->tag->save();

        toast('برچسب با موفقیت ثبت شد','success');

        return redirect()->route('desktop.tags.index');
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
    public function edit(Tag $tag)
    {
        return view('desktop.tag.edit' , compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagUpdateRequest $request,Tag $tag)
    {
        $tag->name = $request->get('name');
        $tag->save();

        toast('برچسب با موفقیت ویرایش شد','success');

        return redirect()->route('desktop.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Tag $tag)
    {
        if ($tag->categories->count() > 0) {
            return response()->json(['title' => 'خطا', 'message' => 'برای این برچسب یادداشت ثبت شده و قابلیت حذف ندارد.'], 403);
        }
        $tag->delete();
        return response()->json('برچسب مورد نظر با موفقیت حذف شد', 200);
    }

}
