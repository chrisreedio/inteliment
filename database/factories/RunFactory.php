<?php

namespace Database\Factories;

use ChrisReedIO\Inteliment\Models\OpenAI\Run;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RunFactory extends Factory
{
    protected $model = Run::class;

    public function definition()
    {
        return [
            'api_id' => $this->faker->word(),
            'object' => $this->faker->word(),
            'api_created_at' => Carbon::now(),
            'thread_id' => $this->faker->randomNumber(),
            'api_thread_id' => $this->faker->word(),
            'api_assistant_id' => $this->faker->word(),
            'status' => $this->faker->word(),
            'required_action' => $this->faker->words(),
            'last_error' => $this->faker->words(),
            'expires_at' => Carbon::now(),
            'started_at' => Carbon::now(),
            'cancelled_at' => Carbon::now(),
            'failed_at' => Carbon::now(),
            'completed_at' => Carbon::now(),
            'model' => $this->faker->word(),
            'instructions' => $this->faker->word(),
            'tools' => $this->faker->words(),
            'file_ids' => $this->faker->words(),
            'metadata' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
