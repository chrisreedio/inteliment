<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\RunStepStatus;
use ChrisReedIO\Inteliment\Enums\OpenAI\RunStepType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RunStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'thread_id',
        'assistant_id',

        'api_id',
        'api_assistant_id',
        'api_thread_id',
        'api_run_id',
        // 'object',

        'type',
        'status',
        'step_details',
        'last_error',
        'expired_at',
        'cancelled_at',
        'failed_at',
        'completed_at',
        'metadata',
        'api_created_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'failed_at' => 'datetime',
        'completed_at' => 'datetime',
        'type' => RunStepType::class,
        'status' => RunStepStatus::class,
        'step_details' => 'array',
        'metadata' => 'array',
        'api_created_at' => 'datetime',
    ];

    public function run(): BelongsTo
    {
        return $this->belongsTo(Run::class);
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(Assistant::class);
    }
}
