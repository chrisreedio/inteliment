<?php

use ChrisReedIO\Inteliment\Models\OpenAI\Assistant;
use ChrisReedIO\Inteliment\Models\OpenAI\Run;
use ChrisReedIO\Inteliment\Models\OpenAI\Thread;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('run_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Run::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Thread::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Assistant::class)->nullable()->constrained()->nullOnDelete();

            $table->string('api_id')->nullable();
            $table->string('api_assistant_id')->nullable();
            $table->string('api_thread_id')->nullable();
            $table->string('api_run_id')->nullable();
            $table->string('object')->default('thread.run.step');


            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->json('step_details')->nullable();
            $table->string('last_error')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('metadata')->nullable(); // This can store a JSON object.
            $table->timestamp('api_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('run_steps');
    }
};
