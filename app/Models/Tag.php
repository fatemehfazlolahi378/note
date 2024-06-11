<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected Tag $tag;
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_tag_relation', 'tag_id', 'category_id');
    }

}
