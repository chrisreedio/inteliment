<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function config;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'api_id',
        // 'object', // Should always be 'thread'
        'metadata',
        'api_created_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'api_created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('inteliment.models.user', 'App\Models\User'));
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function runs(): HasMany
    {
        return $this->hasMany(Run::class);
    }
}
