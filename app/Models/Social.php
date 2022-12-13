<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Social extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function imagePath(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/' . $this->image)
        );
    }

    protected function excerpt(): Attribute
    {
        return new Attribute(
            get: fn () => Str::limit(strip_tags($this->description), 200)
        );
    }

    public function scopeDrafted($query)
    {
        return $query->where('status', 0);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
