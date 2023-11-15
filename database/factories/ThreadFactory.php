<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'api_id' => 'thread_' . Str::random(6),
            'object' => 'thread',
            'metadata' => [ ],
            'api_created_at' => $this->faker->dateTimeBetween('-1 year'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
