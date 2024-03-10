<?php

namespace Happytodev\Emil\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;
use Spatie\ImageOptimizer\OptimizerChainFactory;


class WatchTailwind extends Command
{
    protected $signature = 'emil:watchtailwind';

    protected $description = 'Watch Tailwind Change';

    protected $hidden = true;

    public function handle()
    {
        $this->info('Emil is watching change on your tailwind file...');

        $this->info('>>> Start...');

        $this->info('>>> Watch tailwind...');

        $this->compileTailwindCSS();

        $this->info('>>> Tailwind CSS compiled and saved to "_html/css/main.css" ✅');
    }

    private function compileTailwindCSS()
    {
        $exresult = passthru('npx tailwindcss -w -i ./resources/css/app.css -o ./_html/css/main.css');
    }
 
}
