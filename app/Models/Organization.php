<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
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

    protected function startPeriodText(): Attribute
    {
        return new Attribute(
            get: fn () => Carbon::parse($this->start_period)->translatedFormat('F Y')
        );
    }

    protected function endPeriodText(): Attribute
    {
        return new Attribute(
            get: function () {
                if (!$this->end_period)
                    return __('Until now');

                return Carbon::parse($this->end_period)->translatedFormat('F Y');
            }
        );
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
            get: fn () => Str::limit(strip_tags($this->description), 100)
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
