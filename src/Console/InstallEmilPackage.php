<?php

namespace Happytodev\Emil\Console;

use Illuminate\Console\Command;

class InstallEmilPackage extends Command
{
    protected $signature = 'emil:install';

    protected $description = 'Install Emil';

    public function handle()
    {
        $this->info('Installing Emil Package...');

        $this->info('>>> Install necessary folders...');
        $this->installFolders(true);
        $this->info('>>> Folders "_html" and "content" created ✅');

        $this->info('>>> Publish layouts...');
        $this->publishLayouts(true);
        $this->info('>>> Base layouts published ✅');
    }

    private function installFolders($forcePublish = false)
    {
        $params = [
            '--provider' => "Happytodev\Emil\EmilServiceProvider",
            '--tag' => 'emil-install-folders',
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }

    private function publishLayouts($forcePublish = false)
    {
        $params = [
            '--provider' => "Happytodev\Emil\EmilServiceProvider",
            '--tag' => 'emil-publish-layouts',
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
