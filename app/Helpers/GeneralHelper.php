<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GeneralHelper
{
    public static function generate_filename($title, $file)
    {
        $ext = $file->getClientOriginalExtension();
        return Carbon::now()->timestamp . '_' . Str::slug($title) . '.' . $ext;
    }

    public static function generate_random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public static function delete_image($path)
    {
        Storage::delete('public/' . $path);
        return;
    }

    public static function generate_ticket_number()
    {
        $number = Contact::count() + 1;
        return "CT-" . sprintf('%05d', $number);
    }

    public static function icons()
    {
        $icons = [
            [
                'name' => 'facebook',
                'icon' => 'fab fa-facebook-f',
                'color' => '#3b5998'
            ], [
                'name' => 'twitter',
                'icon' => 'fab fa-twitter',
                'color' => '#00acee'
            ], [
                'name' => 'linkedin',
                'icon' => 'fab fa-linkedin',
                'color' => '#007bb5'
            ], [
                'name' => 'googleplus',
                'icon' => 'fab fa-google-plus-g',
                'color' => '#db4a39'
            ], [
                'name' => 'youtube',
                'icon' => 'fab fa-youtube',
                'color' => '#c4302b'
            ], [
                'name' => 'github',
                'icon' => 'fab fa-github',
                'color' => '#171515'
            ], [
                'name' => 'discord',
                'icon' => 'fab fa-discord',
                'color' => '#7289da'
            ], [
                'name' => 'wordpress',
                'icon' => 'fab fa-wordpress',
                'color' => '#21759b'
            ], [
                'name' => 'stack-overflow',
                'icon' => 'fab fa-stack-overflow',
                'color' => '#ef8236'
            ], [
                'name' => 'tiktok',
                'icon' => 'fab fa-tiktok',
                'color' => '#69C9D0'
            ], [
                'name' => 'instagram',
                'icon' => 'fab fa-instagram',
                'color' => '#c32aa3'
            ], [
                'name' => 'steam',
                'icon' => 'fab fa-steam',
                'color' => '#171a21'
            ], [
                'name' => 'pinterest',
                'icon' => 'fab fa-pinterest',
                'color' => '#bd081c'
            ], [
                'name' => 'telegram',
                'icon' => 'fab fa-telegram',
                'color' => '#0088cc'
            ], [
                'name' => 'whatsapp',
                'icon' => 'fab fa-whatsapp',
                'color' => '#25d366'
            ], [
                'name' => 'line',
                'icon' => 'fab fa-line',
                'color' => '#00b900'
            ], [
                'name' => 'skype',
                'icon' => 'fab fa-skype',
                'color' => '#00aff0'
            ], [
                'name' => 'twitch',
                'icon' => 'fab fa-twitch',
                'color' => '#6441a5'
            ], [
                'name' => 'yahoo',
                'icon' => 'fab fa-yahoo',
                'color' => '#720e9e'
            ], [
                'name' => 'snapchat',
                'icon' => 'fab fa-snapchat',
                'color' => '#fffc00'
            ]
        ];

        return collect($icons);
    }

    public static function icon_names()
    {
        return self::icons()->pluck('name');
    }
}
