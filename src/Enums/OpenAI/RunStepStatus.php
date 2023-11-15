<?php

namespace ChrisReedIO\Inteliment\Enums\OpenAI;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RunStepStatus: string implements HasLabel, HasColor
{
    case IN_PROGRESS = 'in_progress';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case COMPLETED = 'completed';
    case EXPIRED = 'expired';

    public function getLabel(): string
    {
        return match ($this) {
            self::IN_PROGRESS => 'In Progress',
            self::CANCELLED => 'Cancelled',
            self::FAILED => 'Failed',
            self::COMPLETED => 'Completed',
            self::EXPIRED => 'Expired',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IN_PROGRESS => 'blue-600',
            self::CANCELLED => 'gray-600',
            self::FAILED => 'red-600',
            self::COMPLETED => 'green-600',
            self::EXPIRED => 'amber-800',
        };
    }

}
