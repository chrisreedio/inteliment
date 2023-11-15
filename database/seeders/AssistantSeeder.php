<?php

namespace Database\Seeders;

use App\Enums\OpenAI\GPTModel;
use App\Models\Assistant;
use Illuminate\Database\Seeder;

class AssistantSeeder extends Seeder
{
    public function run(): void
    {
        Assistant::factory()->create([
            'name' => '',
            'model' => GPTModel::GPT4Turbo,
            'description' => '',
            'instructions' => '',
            'retrieval' => true,
        ]);
    }
}
