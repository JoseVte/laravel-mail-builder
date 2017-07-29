<?php

namespace Laravel\MailBuilder\Console;

use Config;
use View;
use Storage;
use Illuminate\Console\Command;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class MailBuilderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mails:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert Mail views into views with inline styles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Building mail views from '.config('mail-builder.views'));
        Config::set('filesystems.disks.views', [
            'driver' => 'local',
            'root' => base_path('resources/views'),
        ]);

        $files = Storage::disk('views')->allFiles(config('mail-builder.views'));

        foreach ($files as $file) {
            $name = $this->getViewName($file);

            $this->buildView($name);
        }
    }

    /**
     * Returns filename using dot notation.
     *
     * @param string $file Filename
     *
     * @return string
     */
    private function getViewName($file)
    {
        return str_replace('/', '.', str_replace('.blade.php', '', $file));
    }

    /**
     * Return view name without prefix.
     *
     * @param string $name View name
     *
     * @return string
     */
    private function removePrefix($name)
    {
        $prefix = str_replace('/', '.', ltrim(config('mail-builder.views'), '/')).'.';

        return str_replace($prefix, '', $name);
    }

    /**
     * Build view file converting css to inline css.
     *
     * @param string $name View name
     */
    private function buildView($name)
    {
        $render = View::make($name)->render();
        $cssToInlineStyles = new CssToInlineStyles();

        $file = config('mail-builder.output').'/'.str_replace('.', '/', $this->removePrefix($name)).'.blade.php';
        Storage::disk('views')->put($file, $this->decodeHTML($cssToInlineStyles->convert($render)));
    }

    /**
     * Revert HTML encoding.
     *
     * @param string $html HTML
     *
     * @return string
     */
    private function decodeHTML($html)
    {
        return urldecode(htmlspecialchars_decode(html_entity_decode($html)));
    }
}