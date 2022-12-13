<?php

namespace Database\Seeders;

use App\Helpers\GeneralHelper;
use App\Models\SocialMediaIcon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (GeneralHelper::icons() as $item)
            SocialMediaIcon::create(
                [
                    'name' => $item['name'],
                    'icon' => $item['icon'],
                    'color' => $item['color']
                ]
            );
    }
}
