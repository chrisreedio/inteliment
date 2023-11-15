<?php

use ChrisReedIO\Inteliment\Models\OpenAI\Assistant;
use ChrisReedIO\Inteliment\Models\OpenAI\Thread;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->id();

            // $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Thread::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Assistant::class)->nullable()->constrained()->nullOnDelete();

            $table->string('api_id')->nullable();
            $table->string('api_thread_id')->nullable();
            $table->string('api_assistant_id')->nullable();
            $table->string('object')->default('thread.run');

            $table->string('status')->nullable();
            $table->json('required_action')->nullable();
            $table->json('last_error')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('model')->nullable();
            $table->text('instructions')->nullable();
            $table->json('tools')->nullable();
            $table->json('file_ids')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('api_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
