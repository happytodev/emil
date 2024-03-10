<?php

namespace Happytodev\Emil\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

use Symfony\Component\Process\Process;


class ServeEmilSite extends Command
{
    protected $signature = 'emil:serve';

    protected $description = 'Serve Emil-generated site';

    public function handle()
    {
        $this->info('🚀 Starting Emil Server...');
        
        $this->newLine();
        
        $this->info('Generating Emil static website...');
        
        $this->newLine();
        
        $this->call('emil:generate');
        
        $this->newLine();
        
        $serverProcess = $this->startServer();
        
        $this->info('Server started ✅');

        $this->newLine();
        
        $this->info('Start watching for changes...');
        $watchProcess = $this->startWatch();
        
        $this->info('Emil is watching your changes 👀');
        
        $this->newLine();

        $this->info('You can now proceed your modifications. Do a good job 🤘');
        
        // Wait the end of processus
        $serverProcess->wait();

        $watchProcess->wait();

    }


    private function startServer()
    {
        // Start the web server in the background
        $serverProcess = new Process(['browser-sync', 'start', '--server', '_html', '--files', '_html/**/*']);

        $serverProcess->enableOutput();

        $serverProcess->setTimeout(null); 

        $serverProcess->start(function ($type, $buffer) {
                $this->info($buffer);
        });

        return $serverProcess;
    }

    private function startWatch()
    {
        $watchProcess = new Process(['php', 'artisan', 'emil:watch']);

        $watchProcess->enableOutput();

        // Avoid the process stop
        $watchProcess->setTimeout(null);

        $watchProcess->start(function ($type, $buffer) {
            $this->info($buffer);
        });

        return $watchProcess;
    }

    // private function TailwindBuilder()
    // {
    //     $tailwindBuilderProcess = new Process(['npx', 'tailwindcss', '-w', '-i', './resources/css/app.css', '-o', './_html/css/main.css']);
        
    //     $tailwindBuilderProcess->enableOutput();

    //     $tailwindBuilderProcess->setTimeout(null);

    //     $tailwindBuilderProcess->start(function ($type, $buffer) {
    //         $this->info($buffer);
    //     });

    //     return $tailwindBuilderProcess;
    // }

    // private function waitForProcess(Process $process)
    // {
    //     $process->wait(function ($type, $buffer) {
    //         $this->info($buffer);
    //     });
    // }
}