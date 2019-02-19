<?php

namespace ArcherZdip\Setting\Console;

use Illuminate\Console\Command;

class SettingSetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting:set
                            {key : Setting key}
                            {value : Setting value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an int / string setting.';

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
     * @return mixed
     */
    public function handle()
    {
        app('setting')->set($this->argument('key'), $this->argument('value'));
        $this->info('Setting added. Succ.');
    }
}
