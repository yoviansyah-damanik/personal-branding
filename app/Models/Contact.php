<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function excerpt(): Attribute
    {
        return new Attribute(
            get: fn () => Str::limit(strip_tags($this->message), 200)
        );
    }

    protected function readStatus(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->is_read == 1)
                    return __('Read');

                return __('Unread');
            }
        );
    }

    protected function repliedStatus(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->is_replied == 1)
                    return __('Replied');

                return __('Unreplied');
            }
        );
    }
}
