<?php

namespace App\Enums\OpenAI;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MessageRole: string implements HasLabel, HasColor
{
    case System = 'system';
    case User = 'user';
    case Assistant = 'assistant';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::System => 'gray-600',
            self::User => 'blue-600',
            self::Assistant => 'green-600',
        };
    }
}
