<?php

namespace Database\Factories;

use App\Models\Band;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Band>
 */
class BandFactory extends Factory
{
    protected $model = Band::class;

    public function definition()
    {
        $genre = ['ジャズ', 'ロック', 'メタル', 'JPOP', 'フォーク'];
        return [
            'name' => $this->faker->realText(10),
            'genre' => Arr::random($genre),
            'people_count' => rand(1, 6),
        ];
    }
}
