<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use ChrisReedIO\Inteliment\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Run extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'thread_id',
        'assistant_id',

        'api_id',
        'api_thread_id',
        'api_assistant_id',
        'object',

        'status',
        'required_action',
        'last_error',
        'expires_at',
        'started_at',
        'cancelled_at',
        'failed_at',
        'completed_at',
        'model',
        'instructions',
        'tools',
        'file_ids',
        'metadata',
        'api_created_at',
    ];

    protected $casts = [
        'api_created_at' => 'datetime',
        'required_action' => 'array',
        'last_error' => 'array',
        'expires_at' => 'datetime',
        'started_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'failed_at' => 'datetime',
        'completed_at' => 'datetime',
        'tools' => 'array',
        'file_ids' => 'array',
        'metadata' => 'array',
        'model' => GPTModel::class,
    ];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(Assistant::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function steps(): HasMany
    {
        return $this->runSteps();
    }

    public function runSteps(): HasMany
    {
        return $this->hasMany(RunStep::class);
    }
}
