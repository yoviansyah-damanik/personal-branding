<?php

namespace App\Models;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user'];

    protected static function boot()
    {
        parent::boot();

        $agent = new Agent();
        static::creating(function ($query) use ($agent) {
            $query->ip_address = Request::ip();
            $query->user_id = Auth::id();
            $query->device = $agent->device();
            $query->platform = $agent->platform();
            $query->browser = $agent->browser();
        });
    }

    public static function makeHistory($description, $ref_id = '')
    {
        $ref = $ref_id != null ? $ref_id : null;
        static::create(
            [
                'description' => $description,
                'action' => Route::currentRouteName(),
                'ref_id' => $ref
            ]
        );
    }

    public function fullDescription(): Attribute
    {
        if ($this->ref_id != null)
            return new Attribute(
                get: fn () => $this->description . " <br /> (Ref Id: " . $this->ref_id . ")"
            );

        return new Attribute(
            get: fn () => $this->description
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
