<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use ChrisReedIO\Inteliment\Models\BaseModel;
use ChrisReedIO\OpenAI\SDK\Enums\ToolType;
use ChrisReedIO\OpenAI\SDK\Facades\OpenAI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Assistant extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'model',
        'api_id',
        'name',
        'description',
        'instructions',
        'code_interpreter',
        'retrieval',
        'metadata',
        'api_created_at',
    ];

    protected $casts = [
        'model' => GPTModel::class,
        'metadata' => 'array',
        'api_created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function runs(): HasMany
    {
        return $this->hasMany(Run::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public static function sync(): void
    {
        OpenAI::assistants()->list()->collect()->each(function ($assistant) {
            static::updateOrCreate([
                'api_id' => $assistant->id,
            ], [
                'model' => GPTModel::from($assistant->model),
                'name' => $assistant->name,
                'description' => $assistant->description,
                'instructions' => $assistant->instructions,
                'code_interpreter' => collect($assistant->tools)->contains('type', ToolType::CODE_INTERPRETER->value),
                'retrieval' => collect($assistant->tools)->contains('type', ToolType::RETRIEVAL->value),
                'metadata' => $assistant->metadata,
                'api_created_at' => Carbon::createFromTimestamp($assistant->created_at)->toDateTimeString(),
            ]);
        });
    }
}
