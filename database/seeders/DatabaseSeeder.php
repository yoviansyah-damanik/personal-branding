<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use App\Models\TagDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConfigurationSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(IconSeeder::class);
        // Category::factory(5)->create();
        // Blog::factory(200)->create();
        // Tag::factory(50)->create();
        // TagDetail::factory(1000)->create();
    }
}
