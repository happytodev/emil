<?php

namespace Happytodev\Emil\Console;

use Spatie\Watcher\Watch;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;



class WatchChange extends Command
{
    protected $signature = 'emil:watch';

    protected $description = 'Watch change on content and resource/views';

    protected $hidden = true;

    public function handle()
    {
        $this->info('Watch change on content and resources/views');

        $this->info('Watching...');

        $this->watchContentChanges();
    }

    private function watchContentChanges()
    {     
        Watch::paths('resources/views', 'content', 'themes')
        ->onAnyChange(function (string $type, string $path) {
            //if ($type === Watch::EVENT_TYPE_FILE_CREATED) {
                //$this->line("file {$path} was created");

                // On every detection launch the tailwind compilation
                $process = new Process(['npx', 'tailwindcss', '-i', './resources/css/app.css', '-o', './_html/css/main.css']);
                $process->run();

                // Generate HTML from the content and store it in _html folder
                $this->call('emil:generate');
            //}
        })
        ->start();
    }
}
