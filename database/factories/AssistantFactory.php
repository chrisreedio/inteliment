<?php

namespace Database\Factories;

use App\Enums\OpenAI\GPTModel;
use App\Models\Assistant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AssistantFactory extends Factory
{
    protected $model = Assistant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'model' => GPTModel::GPT4Turbo,
            'description' => $this->faker->sentence(),
            'instructions' => $this->faker->paragraph(),
            'metadata' => [ ],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
