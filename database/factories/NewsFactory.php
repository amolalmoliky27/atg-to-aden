<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = ['سياحة', 'تراث', 'فعاليات', 'ثقافة', 'تطوير'];
        $locations = ['عدن', 'كريتر', 'المعلا', 'التواهي', 'خور مكسر'];

        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(3, true),
            'category' => $categories[array_rand($categories)],
            'location' => $locations[array_rand($locations)],
            'image' => null,
        ];
    }
}
