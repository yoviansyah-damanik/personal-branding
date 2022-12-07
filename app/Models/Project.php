<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

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

    public function sectors()
    {
        return $this->hasManyThrough(Sector::class, SectorDetail::class, 'project_id', 'id', 'id', 'sector_id');
    }
}
