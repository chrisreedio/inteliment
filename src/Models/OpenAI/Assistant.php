<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenAI\Laravel\Facades\OpenAI;
use function dd;
use function dump;

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

    public static function sync(): void
    {
        // $response = OpenAI::assistants()->list([
        //     'limit' => 10,
        // ]);
        // dump($response);
        // foreach ($response->data as $result) {
        //     Assistant::updateOrCreate([
        //         'api_id' => $result->id,
        //     ], [
        //         'model' => GPTModel::from($result->model),
        //         'name' => $result->name,
        //         'description' => $result->description,
        //         'instructions' => $result->instructions,
        //         // 'code_interpreter' => $result->code_interpreter,
        //         // 'retrieval' => $result->retrieval,
        //         'metadata' => $result->metadata,
        //     ]);
        //     dump($result->id . ' - ' . $result->name);
        //     // ...
        // }
    }

}
