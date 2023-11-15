<?php

use ChrisReedIO\Inteliment\Models\OpenAI\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('inteliment.models.user'))->constrained()->cascadeOnDelete();
            $table->string('api_id')->nullable();
            $table->string('object')->default('thread');
            $table->json('metadata')->nullable();
            $table->string('api_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
