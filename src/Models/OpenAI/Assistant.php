<?php

namespace ChrisReedIO\Inteliment\Models\OpenAI;

use ChrisReedIO\Inteliment\Enums\OpenAI\GPTModel;
use ChrisReedIO\OpenAI\SDK\Enums\ListOrder;
use ChrisReedIO\OpenAI\SDK\Enums\ToolType;
use ChrisReedIO\OpenAI\SDK\Facades\OpenAI;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

use function count;

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
        $assistants = OpenAI::assistants()->list(ListOrder::Ascending)->collect();
        // dd($assistants->all());
        $newAssistants = [];
        foreach ($assistants->all() as $assistant) {
            $syncedAssistant = static::updateOrCreate([
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
            if ($syncedAssistant->wasRecentlyCreated) {
                $newAssistants[] = $syncedAssistant;
            }
        }

        Notification::make()
            ->title('Assistants Synced')
            ->icon(config('inteliment.fontawesome', false) ? 'far-file-import' : 'heroicon-o-cloud-upload')
            ->iconColor('success')
            ->body(
                count($assistants->all()) . ' ' . Str::plural('assistant', count($assistants->all())) . ' were synced. '
                . (count($newAssistants) ? count($newAssistants) . ' were created.' : '')
            )
            ->send();
    }
}
