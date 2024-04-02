<?php

namespace Happytodev\Emil\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Artisan;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;

// require __DIR__ . '/../vendor/autoload.php';

class GenerateSite extends Command
{
    protected $signature = 'emil:generate';

    protected $description = 'Generate static website';

    protected $converter;

    protected $optimizerChain;

    protected $contentDir;

    protected $htmlDir;

    public function handle()
    {
        $this->info('Emil try to generate your static website...');

        $this->generate();
    }

    // Parcourir le dossier content et générer les fichiers HTML
    public function generate()
    {
        // Define your configuration, if needed
        $config = [];

        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add the extension
        $environment->addExtension(new FrontMatterExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $this->converter = new MarkdownConverter($environment);

        // $this->converter = new CommonMarkConverter();

        $this->contentDir = base_path('content');

        $this->htmlDir = base_path('_html/');

        // $this->optimizerChain = OptimizerChainFactory::create()
        // ->addOptimizer(new \Spatie\ImageOptimizer\Optimizers\Jpegoptim())
        // ->addOptimizer(new \Spatie\ImageOptimizer\Optimizers\Pngquant())
        // ->addOptimizer(new \Spatie\ImageOptimizer\Optimizers\Optipng());

        foreach (glob($this->contentDir . '/*.md') as $file) {
            // dd($file);
            $content = file_get_contents($file);
            $html = $this->converter->convert($content);

            // Grab the front matter:
            if ($html instanceof RenderedContentWithFrontMatter) {
                $frontMatter = $html->getFrontMatter();
            }

            $html = str_replace('[URL]', 'https://', $html);

            $filename = basename($file, '.md');
            $originalFilename = basename($file);
            //$path = str_replace($this->contentDir, '', $file);

            // $result = file_put_contents($this->htmlDir . $filename . '.html', $html);

            // Transmettez les données nécessaires à la vue Blade (par exemple, $html et $frontMatter) :
            $data = [
                'html' => $html,
                'frontMatter' => $frontMatter ?? '',
            ];

             // Clear the compiled views
             Artisan::call('view:clear');


            $result = file_put_contents($this->htmlDir . $filename . '.html', Blade::render($frontMatter['layout'] ?? 'home', $data));

            $this->info(">>> Static page for $originalFilename has been successfully generated ✅");

            // Optimize pictures
            // foreach (glob($this->htmlDir . $path . '/*.{jpg,jpeg,png,gif}') as $image) {
            //     $this->optimizerChain->optimize($image);
            // }
        }

        // Generate specific pages

        // Blog
        // $articles = glob($contentDir . '/blog/*.md');
        // file_put_contents($publicDir . '/blog/index.html', generateBlogIndex($articles));

        // // Tags
        // $tags = glob($contentDir . '/tags/*.md');
        // file_put_contents($publicDir . '/tags/index.html', generateTagsIndex($tags));

        // // Categories
        // $categories = glob($contentDir . '/categories/*.md');
        // file_put_contents($publicDir . '/categories/index.html', generateCategoriesIndex($categories));

        // // Authors
        // $authors = glob($contentDir . '/authors/*.md');
        // file_put_contents($publicDir . '/authors/index.html', generateAuthorsIndex($authors));

        // // Séries
        // $series = glob($contentDir . '/series/*');
        // foreach ($series as $serie) {
        //     $serieName = basename($serie);
        //     file_put_contents($publicDir . '/series/' . $serieName . '/index.html', generateSeriesIndex($serie));
        // }

        // Génération de la page d'accueil

        // file_put_contents($publicDir . '/index.html', generateHomepage());

        // echo "Le site statique a été généré avec succès." . PHP_EOL;
    }
}
