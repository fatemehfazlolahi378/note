<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => hashid($this['id'], 'note'),
            'title' => $this['title'],
            'content' => Str::limit(strip_tags($this['content']),'120','...'),
            'url' => route('dashboard.notes.show',['slug'=> hashid($this['id'], 'note') . '-' . url_slug($this['title']),'note']),
        ];
    }
}
