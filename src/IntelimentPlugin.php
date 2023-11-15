<?php

namespace ChrisReedIO\Inteliment;

use Filament\Contracts\Plugin;
use Filament\Panel;

class IntelimentPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'inteliment';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            Resources\AssistantResource::class,
            Resources\ThreadResource::class,
            Resources\MessageResource::class,
            Resources\RunResource::class,
            Resources\RunStepResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
