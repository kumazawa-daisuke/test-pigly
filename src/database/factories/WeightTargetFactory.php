<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightTarget;

class WeightTargetFactory extends Factory
{

    protected $model = WeightTarget::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), 
            'target_weight' => $this->faker->randomFloat(1, 40, 90),
        ];
    }
}
