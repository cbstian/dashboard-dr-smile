<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DataLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drsmile:location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carga la base de datos de regiones, provincias y comunas';

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
        $this->info("Eliminando tablas");

        DB::table('communes')->delete();
        DB::unprepared("ALTER TABLE communes AUTO_INCREMENT = 1;");

        DB::table('provinces')->delete();
        DB::unprepared("ALTER TABLE provinces AUTO_INCREMENT = 1;");

        DB::table('regions')->delete();
        DB::unprepared("ALTER TABLE regions AUTO_INCREMENT = 1;");

        $this->info("Cargando datos de regiones, provincias y comunas de chile");

        DB::unprepared( File::get('resources/sql/regions_provinces_communes.sql') );

        $this->info("Realizado.");
    }
}
