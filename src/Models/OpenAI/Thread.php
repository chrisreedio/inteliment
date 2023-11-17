<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\OpenAI\SDK\Facades\OpenAI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use ReflectionException;
use Throwable;
use function config;
use function tap;

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

    /**
     * @throws ReflectionException
     * @throws Throwable
     */
    public static function Spawn(?int $user_id = null): self
    {
        $threadObject = OpenAI::threads()->create();

        return self::updateOrCreate([
            'api_id' => $threadObject->id,
        ], [
            'user_id' => $user_id ?? auth()->user()->id,
            'metadata' => $threadObject->metadata,
            'api_created_at' => $threadObject->created_at,
        ]);
    }
}
