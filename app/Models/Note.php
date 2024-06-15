<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note withSearch($request)
 * @property int $user_id
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUserId($value)
 * @mixin \Eloquent
 */
class Note extends Model
{
    use Searchable;
    use HasFactory;
    protected $table = 'notes';
    protected $guarded = ['id'];
    protected $appends = ['url'];


    public function getUrlAttribute()
    {
        return hashid($this->id,'note') . '-' . url_slug($this->title);
    }
    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function scopeWithSearch($query, $request)
    {
        $where = [];

        if ($request->has('title')) {
            $value = $request->get('title');
            array_push($where, ['title', $value]);
        }
        if (count($where) > 0) {
            return $query->where($where);
        } else {
            return $query;
        }
    }

    public function searchableAs()
    {
        return 'note-index';
    }
    public function shouldBeSearchable()
    {
        return $this->user_id ==  auth()->id();
    }


    public function sortableAttributes()
    {
        return
            [
                'title'
            ];
    }

    public function toSearchableArray()
    {
        return [
            'id' => hashid($this->id, 'note'),
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    public function sortSearchResult()
    {
        return [
            'title:asc',
            'typo',
            'words',
            'sort',
            'proximity',
            'attribute',
            'exactness'
        ];
    }
}
