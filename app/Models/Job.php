<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
