<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['tags', 'category'];

    protected function excerpt(): Attribute
    {
        return new Attribute(
            get: fn () => Str::limit(strip_tags($this->body), 200)
        );
    }

    protected function imagePath(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/' . $this->image)
            // get: fn () => $this->image
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->hasManyThrough(Tag::class, TagDetail::class, 'blog_id', 'id', 'id', 'tag_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 0);
    }

    public function scopePublish($query)
    {
        return $query->where('status', 1);
    }
}
