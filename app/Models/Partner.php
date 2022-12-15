<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;
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
    public function scopeDrafted($query)
    {
        return $query->where('status', 0);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
