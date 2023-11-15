<?php

use ChrisReedIO\Inteliment\Enums\OpenAI\MessageRole;
use ChrisReedIO\Inteliment\Models\OpenAI\Assistant;
use ChrisReedIO\Inteliment\Models\OpenAI\Run;
use ChrisReedIO\Inteliment\Models\OpenAI\Thread;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('inteliment.models.user'))->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Assistant::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Thread::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Run::class)->nullable()->constrained()->nullOnDelete();

            $table->string('api_id')->nullable();
            $table->string('api_assistant_id')->nullable();
            $table->string('api_thread_id')->nullable();
            $table->string('api_run_id')->nullable();
            $table->string('object')->default('thread.message');

            $table->string('role')->default(MessageRole::User->value);
            $table->jsonb('content')->nullable();
            $table->integer('tokens')->nullable();
            $table->json('file_ids')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('api_created_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
