<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'attribute' => 'app_name',
            'value' => 'Roy Subarja'
        ]);

        Configuration::create([
            'attribute' => 'app_abb_name',
            'value' => 'ROY'
        ]);

        Configuration::create([
            'attribute' => 'app_logo',
            'value' => null
        ]);

        Configuration::create([
            'attribute' => 'app_favicon',
            'value' => null
        ]);

        Configuration::create([
            'attribute' => 'app_ads',
            'value' => null
        ]);

        Configuration::create([
            'attribute' => 'app_description',
            'value' => 'Personal Branding'
        ]);

        Configuration::create([
            'attribute' => 'is_maintenance',
            'value' => false
        ]);

        Configuration::create([
            'attribute' => 'owner',
            'value' => 'Roy Efendi Subarja'
        ]);

        Configuration::create([
            'attribute' => 'phone_number',
            'value' => '08123456789'
        ]);

        Configuration::create([
            'attribute' => 'address',
            'value' => 'Padang Sidempuan'
        ]);

        Configuration::create([
            'attribute' => 'email',
            'value' => 'example@gmail.com'
        ]);

        Configuration::create([
            'attribute' => 'googlemaps',
            'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d274.61410761163285!2d99.26085863021798!3d1.3965556261432874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302c1de8512034b5%3A0x31855af7c3d589b8!2sKopi%20Adope!5e0!3m2!1sid!2sid!4v1670441043003!5m2!1sid!2sid'
        ]);

        Configuration::create([
            'attribute' => 'sitemap_frequency',
            'value' => 'always'
        ]);

        Configuration::create([
            'attribute' => 'sitemap_priority',
            'value' => 0
        ]);
        Configuration::create([
            'attribute' => 'keywords',
            'value' => null
        ]);
        Configuration::create([
            'attribute' => 'about_me',
            'value' => null
        ]);
    }
}
