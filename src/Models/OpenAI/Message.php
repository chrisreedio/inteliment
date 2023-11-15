<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\MessageRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'user_id',
        'assistant_id',
        'thread_id',
        'run_id',

        'api_id',
        'api_assistant_id',
        'api_thread_id',
        'api_run_id',
        // 'object',

        'role',
        'content',
        'tokens',
        'file_ids',
        'metadata',
        'api_created_at',
    ];

    protected $casts = [
        'role' => MessageRole::class,
        'content' => 'array',
        'file_ids' => 'array',
        'metadata' => 'array',
        'api_created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(Assistant::class);
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function run(): BelongsTo
    {
        return $this->belongsTo(Run::class);
    }
}
