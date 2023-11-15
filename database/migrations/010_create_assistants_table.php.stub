<?php

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            $table->string('model')->default(GPTModel::GPT4Turbo->value);
            $table->string('api_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            // Tools?
            $table->boolean('code_interpreter')->default(false);
            $table->boolean('retrieval')->default(false);
            // Functions are defined as 'functions' that can be attached via Many-To-Many to Assistants

            $table->json('metadata')->nullable();
            $table->timestamp('api_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
