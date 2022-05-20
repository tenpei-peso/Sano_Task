<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $script = ['PHP', 'Ruby', 'Python', 'Javascript', 'その他の言語'];

        return [
            'account_id' => User::factory(),
            'content' => $this->faker->realText(140),
            'study_time' => rand(1, 24),
            'genre' => Arr::random($script),
            'created_at' => $this->faker->dateTimeBetween('-10 day', '+10day')->format('Y-m-d'),
        ];
    }
}
