<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class GeneralHelper
{
    public static function generate_random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public static function delete_image($path)
    {
        Storage::delete('public/' . $path);
        return;
    }
}
