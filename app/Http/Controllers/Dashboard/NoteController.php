<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desktop\Note\NoteStoreRequest;
use App\Http\Requests\Desktop\Note\NoteUpdateRequest;
use App\Http\Resources\AdvertiseSearchResource;
use App\Http\Resources\NoteResource;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;
use Meilisearch\Client;

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
    public function index(Request $request)
    {
        $notes = $this->note->withSearch($request)->paginate($this->perPage());
        return view('dashboard.note.index', compact('notes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->whereParentId(0)->get();
        return view('dashboard.note.create', compact('categories'));
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

        return redirect()->route('dashboard.notes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
      $id = unhashid(explode('-' , $slug)[0] , 'note');
      $note = $this->note->whereId($id)->first();
      return view('dashboard.note.show' , compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $all_categories = [];
        $categories = $this->category->whereParentId($note->category->parent_id)->get();
        $categories->map(function ($category) use ($note){
            $category->selected = $category->id == $note->category_id ? true : false;
        });
        array_unshift($all_categories, $categories);

        $category = $note->category()->first();
        $category_count = $note->category->parent->count();

        while ($category_count) {
            $category = $category->parent()->first();
            $category_count = $category->parent()->count();
            $categories = $this->category->whereParentId($category->parent_id)->get();
            $categories->map(function ($cat) use ($category) {
                $cat->selected = $cat->id == $category->id ? true : false;
            });
            array_unshift($all_categories, $categories);

        }

        return view('dashboard.note.edit', compact('note' , 'all_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteUpdateRequest $request, Note $note)
    {
        $note->title = $request->get('title');
        $note->category_id = $request->get('category_id');
        $note->content = $request->get('content');
        $note->save();

        toast('یادداشت با موفقیت ویرایش شد','success');

        return redirect()->route('dashboard.notes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return response()->json('یادداشت مورد نظر با موفقیت حذف شد', 200);
    }

    /**
     * Get date with meilisearch.
     */
    public function getData(Request $request)
    {
        $client = new Client('http://127.0.0.1:7700', config('scout.meilisearch.key'));
        if ($request->get('value')) {
            $documents = [
                'note'
                => NoteResource::collection($client->index('note-index')->search($request->get('value'),['limit'=>15])->getHits()),
            ];
            return \Response::json($documents);
        }
    }
}
