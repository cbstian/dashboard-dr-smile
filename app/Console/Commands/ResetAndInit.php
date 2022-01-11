<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class ResetAndInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mainque:reset-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina todos los datos y vuelve a cargar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (App::environment('local')) {

            Artisan::call('migrate:fresh', [
                '--force' => true,
            ]);

            Artisan::call('drsmile:location');

            Artisan::call('db:seed');

        } else {
            $this->error('Comando solo ejecutable en local');
        }

        return Command::SUCCESS;
    }
}
