<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;

    public function definition()
    {
        $gender = ['男', '女', 'その他'];
        $part = ['ギター', 'ドラム', 'ベース', 'キーボード', 'ボーカル'];
        return [
            'name' => $this->faker->name(),
            'grade' => rand(1, 4),
            'gender' => Arr::random($gender),
            'part' => Arr::random($part),
        ];
    }
}
