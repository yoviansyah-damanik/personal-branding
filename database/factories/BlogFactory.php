<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $body = collect($this->faker->paragraphs(mt_rand(10, 30)))
            ->map(fn ($p) => "<p>$p</p>")
            ->implode('');

        $status = mt_rand(0, 1);
        if ($status == 1)
            $published_at = $this->faker->dateTimeBetween($startDate = '-10 days', $endDate = 'now');
        else
            $published_at = null;

        return [
            'title' => $this->faker->sentence(mt_rand(8, 12)),
            'body' => $body,
            'status' => $status,
            'image' => $this->faker->imageUrl(600, 600),
            'category_id' => mt_rand(1, 5),
            'published_at' => $published_at,
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now')
        ];
    }
}
