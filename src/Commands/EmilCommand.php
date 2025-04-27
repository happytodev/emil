<?php

namespace Happytodev\Emil\Commands;

use Illuminate\Console\Command;

class EmilCommand extends Command
{
    public $signature = 'emil';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
