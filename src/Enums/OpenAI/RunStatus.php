<?php

namespace App\Enums\OpenAI;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RunStatus: string implements HasLabel, HasColor
{
    case QUEUED = 'queued';
    case IN_PROGRESS = 'in_progress';
    case REQUIRES_ACTION = 'requires_action';
    case CANCELLING = 'cancelling';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';
    case COMPLETED = 'completed';
    case EXPIRED = 'expired';

    public function getLabel(): string
    {
        return match ($this) {
            self::QUEUED => 'Queued',
            self::IN_PROGRESS => 'In Progress',
            self::REQUIRES_ACTION => 'Requires Action',
            self::CANCELLING => 'Cancelling',
            self::CANCELLED => 'Cancelled',
            self::FAILED => 'Failed',
            self::COMPLETED => 'Completed',
            self::EXPIRED => 'Expired',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::QUEUED => 'gray-600',
            self::IN_PROGRESS => 'blue-600',
            self::REQUIRES_ACTION => 'orange-600',
            self::CANCELLING => 'yellow-600',
            self::CANCELLED => 'yellow-400',
            self::FAILED => 'red-600',
            self::COMPLETED => 'green-600',
            self::EXPIRED => 'amber-800',
        };
    }

}
