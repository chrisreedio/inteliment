<?php

namespace Database\Seeders;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use ChrisReedIO\Inteliment\Models\Assistant;
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
