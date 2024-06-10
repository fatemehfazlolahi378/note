<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desktop\Note\NoteStoreRequest;
use App\Http\Requests\Desktop\Note\NoteUpdateRequest;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected Note $note;
    protected Category $category;
    public function __construct(Note $note , Category $category)
    {
        $this->note = $note;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = $this->note->paginate($this->perPage());
        return view('desktop.note.index', compact('notes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->whereParentId(0)->get();
        return view('desktop.note.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteStoreRequest $request)
    {
        $this->note->title = $request->get('title');
        $this->note->category_id = $request->get('category_id');
        $this->note->content = $request->get('content');
        $this->note->save();

        toast('یادداشت با موفقیت ثبت شد','success');

        return redirect()->route('desktop.notes.index');
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
    public function edit(Note $note)
    {
        $categories = $this->category->whereParentId(0)->get();
        return view('desktop.note.edit', compact('note' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteUpdateRequest $request, $note)
    {
        $note->title = $request->get('title');
        $note->category_id = $request->get('category_id');
        $note->content = $request->get('content');
        $note->save();

        toast('یادداشت با موفقیت ثبت شد','success');

        return redirect()->route('desktop.notes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($note)
    {
        $note->delete();
        return response()->json('یادداشت مورد نظر با موفقیت حذف شد', 200);
    }
}
