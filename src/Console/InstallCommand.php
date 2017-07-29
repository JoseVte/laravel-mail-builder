<?php

namespace Laravel\MailBuilder\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mails:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install MailBuilder into application.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!is_dir(base_path('resources/views/emails/templates'))) {
            mkdir(base_path('resources/views/emails/templates'), 0755, true);
        }

        $subs = [
            'Config/default.php' => base_path('config/mail-builder.php'),
            'Resources/views/confirmation.blade.php' => base_path('resources/views/emails/templates/confirmation.blade.php'),
            'Resources/views/password.blade.php' => base_path('resources/views/emails/templates/password.blade.php'),
            'Resources/views/email.blade.php' => base_path('resources/views/layout/email.blade.php'),
        ];

        foreach ($subs as $stub => $file) {
            if (!is_file($file)) {
                copy(__DIR__.'/../'.$stub, $file);
            }
        }

        $this->info('MailBuilder scaffolding installed successfully.');
    }
}
