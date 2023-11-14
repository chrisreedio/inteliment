<?php

namespace ChrisReedIO\Inteliment\Commands;

use Illuminate\Console\Command;

class IntelimentCommand extends Command
{
    public $signature = 'inteliment';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
