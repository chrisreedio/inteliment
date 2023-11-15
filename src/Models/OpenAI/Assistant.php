<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'api_id',
        'name',
        'description',
        'instructions',
        'code_interpreter',
        'retrieval',
        'metadata',
    ];

    protected $casts = [
        'model' => GPTModel::class,
        'metadata' => 'array',
    ];

    public function runs(): HasMany
    {
        return $this->hasMany(Run::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
