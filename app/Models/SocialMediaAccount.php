<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaAccount extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function social_media_icon()
    {
        return $this->belongsTo(SocialMediaIcon::class);
    }
}
