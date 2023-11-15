<?php

namespace Database\Factories;

use ChrisReedIO\Inteliment\Enums\OpenAI\MessageRole;
use ChrisReedIO\Inteliment\Models\Message;
use ChrisReedIO\Inteliment\Models\Thread;
use ChrisReedIO\Inteliment\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'thread_id' => Thread::factory(),
            'role' => $this->faker->randomElement(MessageRole::cases())->value,
            'content' => $this->faker->paragraph(),
            'tokens' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
