<?php

namespace ChrisReedIO\Inteliment\Enums\OpenAI;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RunStepType: string implements HasColor, HasLabel
{
    case MESSAGE_CREATION = 'message_creation';
    case TOOL_CALLS = 'tool_calls';

    public function getLabel(): string
    {
        return match ($this) {
            self::MESSAGE_CREATION => 'Message Creation',
            self::TOOL_CALLS => 'Tool Calls',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::MESSAGE_CREATION => 'blue-600',
            self::TOOL_CALLS => 'orange-600',
        };
    }
}
