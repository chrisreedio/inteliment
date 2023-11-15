<?php

namespace App\Enums\OpenAI;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum GPTModel: string implements HasLabel, HasColor
{
    case GPT35Turbo = 'gpt-3.5-turbo';
    case GPT4 = 'gpt-4';
    case GPT4Turbo = 'gpt-4-turbo';
    // case GPT4Vision = 'gpt-4-vision';

    public function getLabel(): string
    {
        return match ($this) {
            self::GPT35Turbo => 'GPT-3.5 Turbo',
            self::GPT4 => 'GPT-4',
            self::GPT4Turbo => 'GPT-4 Turbo',
            // self::GPT4Vision => 'GPT-4 Vision'

        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::GPT35Turbo => 'orange-600',
            self::GPT4 => 'yellow-600',
            self::GPT4Turbo => 'blue-600',
            // self::GPT4Vision => 'green-600'
        };
    }

    public function openAI(): string
    {
        return match ($this) {
            self::GPT35Turbo => 'gpt-3.5-turbo-1106',
            self::GPT4 => 'gpt-4', // Could swap this with gpt-4-32k
            self::GPT4Turbo => 'gpt-4-1106-preview',
            // self::GPT4Vision => 'gpt-4-vision-preview'
        };
    }

}
